<?php

namespace Tests\Feature;

use App\Filament\Pages\CareersAndReferrals;
use App\Mail\ReferralConfirmationMail;
use App\Mail\ReferralReceivedMail;
use App\Models\ClientReferral;
use App\Models\FastInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ClientReferralWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_referral_form_submission_creates_record_and_dispatches_emails(): void
    {
        Mail::fake();

        $response = $this->post(route('referrals.submit'), [
            'referrer_name'         => 'Evans Korir',
            'referrer_contact'      => 'evans@partner.co.ke',
            'client_name'           => 'Apex Holdings Kenya',
            'client_contact_person' => 'Grace Mwikali (Finance Director)',
            'client_email'          => 'finance@apexholdings.co.ke',
            'client_phone'          => '+254711889900',
            'services_needed'       => 'Enterprise ERP and Cloud Accounting Integration',
            'notes'                 => 'Urgent Q4 procurement rollout.',
        ]);

        $response->assertSessionHas('referral_success', true);
        $response->assertSessionHas('referral_code');

        $this->assertDatabaseHas('client_referrals', [
            'referrer_name'         => 'Evans Korir',
            'referrer_contact'      => 'evans@partner.co.ke',
            'client_name'           => 'Apex Holdings Kenya',
            'client_contact_person' => 'Grace Mwikali (Finance Director)',
            'client_email'          => 'finance@apexholdings.co.ke',
            'client_phone'          => '+254711889900',
            'payout_status'         => 'Pending',
            'status'                => 'Pending Review',
            'promoted_to_lead'      => false,
        ]);

        Mail::assertSent(ReferralConfirmationMail::class, function ($mail) {
            return $mail->hasTo('evans@partner.co.ke');
        });

        Mail::assertSent(ReferralReceivedMail::class);
    }

    public function test_promote_referral_to_lead_creates_fast_inquiry(): void
    {
        $user = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@waverontechnologies.co.ke',
            'password' => bcrypt('password'),
        ]);
        $this->actingAs($user);

        $referral = ClientReferral::create([
            'referral_code'         => ClientReferral::generateCode(),
            'referrer_name'         => 'Sarah Mutua',
            'referrer_contact'      => 'sarah@network.co.ke',
            'client_name'           => 'Kilifi Agro Industries',
            'client_contact_person' => 'Hassan Omar (Operations)',
            'client_email'          => 'hassan@kilifiagro.co.ke',
            'client_phone'          => '+254722334455',
            'services_needed'       => 'IoT Sensor Integration & Dashboard',
            'notes'                 => 'Ready to meet on Monday.',
            'commission_amount'     => 20000,
            'payout_status'         => 'Pending',
            'status'                => 'Pending Review',
            'promoted_to_lead'      => false,
        ]);

        Livewire::test(CareersAndReferrals::class)
            ->call('promoteReferralToLead', $referral->id);

        $referral->refresh();
        $this->assertTrue($referral->promoted_to_lead);
        $this->assertNotNull($referral->promoted_lead_id);
        $this->assertEquals('Active Lead', $referral->status);

        $this->assertDatabaseHas('fast_inquiries', [
            'id'      => $referral->promoted_lead_id,
            'company' => 'Kilifi Agro Industries',
            'name'    => 'Hassan Omar (Operations)',
            'email'   => 'hassan@kilifiagro.co.ke',
        ]);
    }

    public function test_update_referral_status_and_payout_status(): void
    {
        $user = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@waverontechnologies.co.ke',
            'password' => bcrypt('password'),
        ]);
        $this->actingAs($user);

        $referral = ClientReferral::create([
            'referral_code'    => ClientReferral::generateCode(),
            'referrer_name'    => 'David Mwangi',
            'referrer_contact' => '+254799000111',
            'client_name'      => 'Beta Tech Logistics',
            'services_needed'  => 'Fleet tracking',
            'payout_status'    => 'Pending',
            'status'           => 'Pending Review',
        ]);

        Livewire::test(CareersAndReferrals::class)
            ->call('updateReferralStatus', $referral->id, 'Converted / Won')
            ->call('updatePayoutStatus', $referral->id, 'Paid')
            ->call('updateCommission', $referral->id, 25000);

        $referral->refresh();
        $this->assertEquals('Converted / Won', $referral->status);
        $this->assertEquals('Paid', $referral->payout_status);
        $this->assertEquals(25000, $referral->commission_amount);
    }
}
