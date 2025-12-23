@extends('layouts.app')

@section('title', $lead->full_name . ' - Lead Details - Waveron Technologies')

@push('styles')
<style>
    .lead-detail-hero {
        background: linear-gradient(135deg, #006400 0%, #004d00 100%);
        padding: 2rem 0;
        color: white;
    }
    
    .detail-card {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .detail-section-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #006400;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e9ecef;
    }
    
    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        width: 150px;
        flex-shrink: 0;
    }
    
    .info-value {
        color: #212529;
        flex: 1;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .status-new { background: #fff3cd; color: #856404; }
    .status-contacted { background: #d1ecf1; color: #0c5460; }
    .status-qualified { background: #d4edda; color: #155724; }
    .status-proposal_sent { background: #cfe2ff; color: #084298; }
    .status-converted { background: #d1e7dd; color: #0f5132; }
    .status-lost { background: #f8d7da; color: #842029; }
    
    .source-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        background: #e9ecef;
        color: #495057;
    }
    
    .note-item, .communication-item, .task-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 3px solid #006400;
    }
    
    .quote-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 3px solid #006400;
    }
    
    .back-link {
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .back-link:hover {
        color: #e9ecef;
    }
</style>
@endpush

@section('content')
<div class="lead-detail-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('leads.index') }}" class="back-link mb-3">
                    <i class="bi bi-arrow-left"></i> Back to Leads
                </a>
                <h1 class="display-5 fw-bold mb-2">{{ $lead->full_name }}</h1>
                <p class="lead mb-0">{{ $lead->lead_number }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Contact Information -->
            <div class="detail-card">
                <h3 class="detail-section-title">Contact Information</h3>
                <div class="info-row">
                    <div class="info-label">Name</div>
                    <div class="info-value">{{ $lead->full_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
                    </div>
                </div>
                @if($lead->phone)
                <div class="info-row">
                    <div class="info-label">Phone</div>
                    <div class="info-value">
                        <a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a>
                    </div>
                </div>
                @endif
                @if($lead->company)
                <div class="info-row">
                    <div class="info-label">Company</div>
                    <div class="info-value">{{ $lead->company }}</div>
                </div>
                @endif
                @if($lead->job_title)
                <div class="info-row">
                    <div class="info-label">Job Title</div>
                    <div class="info-value">{{ $lead->job_title }}</div>
                </div>
                @endif
                @if($lead->website)
                <div class="info-row">
                    <div class="info-label">Website</div>
                    <div class="info-value">
                        <a href="{{ $lead->website }}" target="_blank">{{ $lead->website }}</a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Address Information -->
            @if($lead->address || $lead->city || $lead->state || $lead->zip_code || $lead->country)
            <div class="detail-card">
                <h3 class="detail-section-title">Address</h3>
                @if($lead->address)
                <div class="info-row">
                    <div class="info-label">Address</div>
                    <div class="info-value">{{ $lead->address }}</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-label">Location</div>
                    <div class="info-value">
                        {{ trim(implode(', ', array_filter([$lead->city, $lead->state, $lead->zip_code, $lead->country]))) ?: 'N/A' }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Notes -->
            @if($lead->notes || $lead->notes()->count() > 0)
            <div class="detail-card">
                <h3 class="detail-section-title">Notes</h3>
                @if($lead->notes)
                <div class="note-item">
                    <p class="mb-0">{{ $lead->notes }}</p>
                </div>
                @endif
                @if($lead->notes()->count() > 0)
                    @foreach($lead->notes as $note)
                    <div class="note-item">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <strong>{{ $note->user->name ?? 'System' }}</strong>
                            <small class="text-muted">{{ $note->created_at->format('M d, Y H:i') }}</small>
                        </div>
                        <p class="mb-0">{{ $note->note }}</p>
                        @if($note->is_important)
                        <span class="badge bg-warning mt-2">Important</span>
                        @endif
                    </div>
                    @endforeach
                @endif
            </div>
            @endif

            <!-- Communications -->
            @if($lead->communications()->count() > 0)
            <div class="detail-card">
                <h3 class="detail-section-title">Communications</h3>
                @foreach($lead->communications as $communication)
                <div class="communication-item">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong>{{ $communication->user->name ?? 'System' }}</strong>
                            <span class="badge bg-secondary ms-2">{{ ucfirst($communication->type) }}</span>
                            <span class="badge bg-info ms-2">{{ ucfirst($communication->direction) }}</span>
                        </div>
                        <small class="text-muted">{{ $communication->occurred_at?->format('M d, Y H:i') ?? $communication->created_at->format('M d, Y H:i') }}</small>
                    </div>
                    @if($communication->subject)
                    <h6 class="mb-2">{{ $communication->subject }}</h6>
                    @endif
                    <p class="mb-0">{{ $communication->content }}</p>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Tasks -->
            @if($lead->tasks()->count() > 0)
            <div class="detail-card">
                <h3 class="detail-section-title">Tasks</h3>
                @foreach($lead->tasks as $task)
                <div class="task-item">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong>{{ $task->title }}</strong>
                            <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }} ms-2">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                            @if($task->priority)
                            <span class="badge bg-danger ms-2">{{ ucfirst($task->priority) }} Priority</span>
                            @endif
                        </div>
                        @if($task->due_date)
                        <small class="text-muted">Due: {{ $task->due_date->format('M d, Y') }}</small>
                        @endif
                    </div>
                    @if($task->description)
                    <p class="mb-2">{{ $task->description }}</p>
                    @endif
                    @if($task->assignedUser)
                    <small class="text-muted">Assigned to: {{ $task->assignedUser->name }}</small>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <!-- Quotes -->
            @if($lead->quotes()->count() > 0)
            <div class="detail-card">
                <h3 class="detail-section-title">Related Quotes</h3>
                @foreach($lead->quotes as $quote)
                <div class="quote-item">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong>{{ $quote->quote_number }}</strong>
                            <span class="badge bg-{{ $quote->status === 'accepted' ? 'success' : ($quote->status === 'sent' ? 'info' : 'secondary') }} ms-2">
                                {{ ucfirst(str_replace('_', ' ', $quote->status)) }}
                            </span>
                        </div>
                        <small class="text-muted">{{ $quote->created_at->format('M d, Y') }}</small>
                    </div>
                    @if($quote->service)
                    <p class="mb-1"><strong>Service:</strong> {{ $quote->service->title }}</p>
                    @endif
                    @if($quote->total)
                    <p class="mb-0"><strong>Total:</strong> ${{ number_format($quote->total, 2) }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Lead Status Card -->
            <div class="detail-card">
                <h3 class="detail-section-title">Lead Details</h3>
                <div class="info-row">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ $lead->status }}">
                            {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                        </span>
                    </div>
                </div>
                @if($lead->source)
                <div class="info-row">
                    <div class="info-label">Source</div>
                    <div class="info-value">
                        <span class="source-badge">{{ ucfirst(str_replace('_', ' ', $lead->source)) }}</span>
                    </div>
                </div>
                @endif
                @if($lead->estimated_value)
                <div class="info-row">
                    <div class="info-label">Estimated Value</div>
                    <div class="info-value">
                        <strong class="text-primary">${{ number_format($lead->estimated_value, 2) }}</strong>
                    </div>
                </div>
                @endif
                @if($lead->assignedUser)
                <div class="info-row">
                    <div class="info-label">Assigned To</div>
                    <div class="info-value">{{ $lead->assignedUser->name }}</div>
                </div>
                @endif
                @if($lead->contacted_at)
                <div class="info-row">
                    <div class="info-label">Contacted At</div>
                    <div class="info-value">{{ $lead->contacted_at->format('M d, Y') }}</div>
                </div>
                @endif
                @if($lead->converted_at)
                <div class="info-row">
                    <div class="info-label">Converted At</div>
                    <div class="info-value">{{ $lead->converted_at->format('M d, Y') }}</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-label">Created</div>
                    <div class="info-value">{{ $lead->created_at->format('M d, Y H:i') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Last Updated</div>
                    <div class="info-value">{{ $lead->updated_at->format('M d, Y H:i') }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="detail-card">
                <h3 class="detail-section-title">Quick Actions</h3>
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $lead->email }}" class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i> Send Email
                    </a>
                    @if($lead->phone)
                    <a href="tel:{{ $lead->phone }}" class="btn btn-outline-primary">
                        <i class="bi bi-telephone me-2"></i> Call
                    </a>
                    @endif
                    <a href="{{ route('leads.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
