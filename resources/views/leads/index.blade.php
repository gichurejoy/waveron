@extends('layouts.app')

@section('title', 'Leads - Waveron Technologies')

@push('styles')
<style>
    .leads-hero {
        background: linear-gradient(135deg, #006400 0%, #004d00 100%);
        padding: 3rem 0;
        color: white;
    }
    
    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-number {
        font-size: 2rem;
        font-weight: bold;
        color: #006400;
    }
    
    .lead-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s;
        height: 100%;
        border-left: 4px solid #006400;
    }
    
    .lead-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
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
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        background: #e9ecef;
        color: #495057;
    }
    
    .filter-section {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .view-toggle {
        display: flex;
        gap: 0.5rem;
    }
    
    .view-toggle button {
        padding: 0.5rem 1rem;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .view-toggle button.active {
        background: #006400;
        color: white;
        border-color: #006400;
    }
</style>
@endpush

@section('content')
<div class="leads-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 fw-bold mb-3">Leads Management</h1>
                <p class="lead">Manage and track all your leads in one place</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Stats Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stats-card text-center">
                <div class="stats-number">{{ $stats['total'] }}</div>
                <div class="text-muted">Total Leads</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card text-center">
                <div class="stats-number">{{ $stats['new'] }}</div>
                <div class="text-muted">New</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card text-center">
                <div class="stats-number">{{ $stats['contacted'] }}</div>
                <div class="text-muted">Contacted</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card text-center">
                <div class="stats-number">{{ $stats['qualified'] }}</div>
                <div class="text-muted">Qualified</div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('leads.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Search leads..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All Statuses</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="qualified" {{ request('status') == 'qualified' ? 'selected' : '' }}>Qualified</option>
                        <option value="proposal_sent" {{ request('status') == 'proposal_sent' ? 'selected' : '' }}>Proposal Sent</option>
                        <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Converted</option>
                        <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Source</label>
                    <select name="source" class="form-select">
                        <option value="all" {{ request('source') == 'all' || !request('source') ? 'selected' : '' }}>All Sources</option>
                        <option value="website" {{ request('source') == 'website' ? 'selected' : '' }}>Website</option>
                        <option value="referral" {{ request('source') == 'referral' ? 'selected' : '' }}>Referral</option>
                        <option value="cold_call" {{ request('source') == 'cold_call' ? 'selected' : '' }}>Cold Call</option>
                        <option value="social_media" {{ request('source') == 'social_media' ? 'selected' : '' }}>Social Media</option>
                        <option value="email" {{ request('source') == 'email' ? 'selected' : '' }}>Email</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Leads Grid -->
    <div class="row g-4">
        @forelse($leads as $lead)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('leads.show', $lead) }}" class="text-decoration-none">
                <div class="lead-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 fw-bold">{{ $lead->full_name }}</h5>
                            <small class="text-muted">{{ $lead->lead_number }}</small>
                        </div>
                        <span class="status-badge status-{{ $lead->status }}">
                            {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                        </span>
                    </div>
                    
                    <div class="mb-3">
                        <div class="mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            <small>{{ $lead->email }}</small>
                        </div>
                        @if($lead->phone)
                        <div class="mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            <small>{{ $lead->phone }}</small>
                        </div>
                        @endif
                        @if($lead->company)
                        <div>
                            <i class="bi bi-building me-2"></i>
                            <small>{{ $lead->company }}</small>
                        </div>
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        @if($lead->source)
                        <span class="source-badge">{{ ucfirst(str_replace('_', ' ', $lead->source)) }}</span>
                        @endif
                        @if($lead->estimated_value)
                        <strong class="text-primary">${{ number_format($lead->estimated_value, 2) }}</strong>
                        @endif
                    </div>
                    
                    @if($lead->assignedUser)
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted">
                            <i class="bi bi-person me-1"></i>
                            Assigned to: {{ $lead->assignedUser->name }}
                        </small>
                    </div>
                    @endif
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h3 class="mt-3">No leads found</h3>
                <p class="text-muted">Try adjusting your filters or create a new lead.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($leads->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            {{ $leads->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
