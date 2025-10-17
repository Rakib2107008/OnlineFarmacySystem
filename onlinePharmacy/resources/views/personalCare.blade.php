@include('components.product-listing', [
    'items' => $products,
    'title' => 'Personal Care Products',
    'emptyIcon' => 'fas fa-spray-can',
    'emptyTitle' => 'No personal care products available at the moment',
    'emptyMessage' => 'Please check back later for new products'
])
