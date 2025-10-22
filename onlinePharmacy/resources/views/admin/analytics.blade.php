@extends('layouts.adminLayout')

@section('title', 'Analytics')
@section('page-title', 'Analytics')

@section('content')
<style>
.analytics-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.chart-container {
    position: relative;
    height: 300px;
}

.stat-item {
    padding: 15px;
    background: #f8f9fc;
    border-radius: 8px;
    margin-bottom: 10px;
}

.stat-item strong {
    color: #4e73df;
}

.progress {
    height: 25px;
    border-radius: 8px;
}

.progress-bar {
    font-weight: 600;
}
</style>

<div class="row g-4">
    <!-- Monthly Sales -->
    <div class="col-lg-12">
        <div class="analytics-card">
            <h5 class="mb-4"><i class="fas fa-chart-line me-2"></i>Monthly Sales (Last 6 Months)</h5>
            @if($monthlySales->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Total Orders</th>
                                <th>Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monthlySales as $sale)
                            <tr>
                                <td><strong>{{ date('F', mktime(0, 0, 0, $sale->month, 1)) }}</strong></td>
                                <td>{{ $sale->year }}</td>
                                <td><span class="badge bg-primary">{{ $sale->orders }} orders</span></td>
                                <td><strong class="text-success">৳{{ number_format($sale->total, 2) }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center">No sales data available</p>
            @endif
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="col-lg-6">
        <div class="analytics-card">
            <h5 class="mb-4"><i class="fas fa-trophy me-2 text-warning"></i>Top Selling Products</h5>
            @if($topProducts->count() > 0)
                @foreach($topProducts as $product)
                <div class="stat-item">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ $product->name }}</strong>
                        <span class="badge bg-success">{{ $product->total_sold }} sold</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" 
                             style="width: {{ ($product->total_sold / $topProducts->max('total_sold')) * 100 }}%">
                            {{ $product->total_sold }}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted text-center">No product sales data</p>
            @endif
        </div>
    </div>

    <!-- Top Selling Medicines -->
    <div class="col-lg-6">
        <div class="analytics-card">
            <h5 class="mb-4"><i class="fas fa-pills me-2 text-info"></i>Top Selling Medicines</h5>
            @if($topMedicines->count() > 0)
                @foreach($topMedicines as $medicine)
                <div class="stat-item">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ $medicine->name }}</strong>
                        <span class="badge bg-info">{{ $medicine->total_sold }} sold</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info" 
                             style="width: {{ ($medicine->total_sold / $topMedicines->max('total_sold')) * 100 }}%">
                            {{ $medicine->total_sold }}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted text-center">No medicine sales data</p>
            @endif
        </div>
    </div>

    <!-- Order Status Distribution -->
    <div class="col-lg-6">
        <div class="analytics-card">
            <h5 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Orders by Status</h5>
            @if($ordersByStatus->count() > 0)
                @foreach($ordersByStatus as $status)
                <div class="stat-item">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ ucfirst($status->status) }}</strong>
                        <span class="badge 
                            @if($status->status == 'confirmed') bg-success
                            @elseif($status->status == 'pending') bg-warning
                            @elseif($status->status == 'cancelled') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $status->count }}
                        </span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar 
                            @if($status->status == 'confirmed') bg-success
                            @elseif($status->status == 'pending') bg-warning
                            @elseif($status->status == 'cancelled') bg-danger
                            @else bg-secondary
                            @endif" 
                             style="width: {{ ($status->count / $ordersByStatus->sum('count')) * 100 }}%">
                            {{ number_format(($status->count / $ordersByStatus->sum('count')) * 100, 1) }}%
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted text-center">No order data</p>
            @endif
        </div>
    </div>

    <!-- Payment Status Distribution -->
    <div class="col-lg-6">
        <div class="analytics-card">
            <h5 class="mb-4"><i class="fas fa-money-bill-wave me-2"></i>Orders by Payment Status</h5>
            @if($ordersByPaymentStatus->count() > 0)
                @foreach($ordersByPaymentStatus as $payment)
                <div class="stat-item">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ ucfirst($payment->payment_status) }}</strong>
                        <span class="badge 
                            @if($payment->payment_status == 'paid') bg-success
                            @elseif($payment->payment_status == 'unpaid') bg-warning
                            @elseif($payment->payment_status == 'failed') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $payment->count }}
                        </span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar 
                            @if($payment->payment_status == 'paid') bg-success
                            @elseif($payment->payment_status == 'unpaid') bg-warning
                            @elseif($payment->payment_status == 'failed') bg-danger
                            @else bg-secondary
                            @endif" 
                             style="width: {{ ($payment->count / $ordersByPaymentStatus->sum('count')) * 100 }}%">
                            {{ number_format(($payment->count / $ordersByPaymentStatus->sum('count')) * 100, 1) }}%
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted text-center">No payment data</p>
            @endif
        </div>
    </div>
</div>

@endsection
