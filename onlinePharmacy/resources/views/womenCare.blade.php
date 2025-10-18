@extends('layouts.app')

@section('content')
<style>
  .products-section { padding: 60px 0; background: white; }
  .section-title { font-size: 32px; font-weight: 700; color: #333; margin-bottom: 40px; text-align: left; }
  .product-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: .3s; margin-bottom: 20px; position: relative; overflow: hidden; }
  .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
  .discount-badge { position: absolute; top: 15px; right: 15px; background: #ff4757; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
  .product-img { width: 100%; height: 200px; object-fit: contain; margin-bottom: 15px; }
  .product-name { font-size: 16px; font-weight: 600; color: #333; margin-bottom: 15px; min-height: 48px; }
  .product-price { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
  .current-price { font-size: 22px; font-weight: 700; color: #0066cc; }
  .old-price { font-size: 16px; color: #999; text-decoration: line-through; }
  .btn-add-cart { width: 100%; padding: 12px; background: #0066cc; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: .3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
  .btn-add-cart:hover { background: #0052a3; }
  .empty-state { text-align: center; padding: 80px 20px; }
  .empty-state i { font-size: 64px; color: #ddd; margin-bottom: 20px; }
  .empty-state h5 { color: #666; font-size: 20px; margin-bottom: 10px; }
  .empty-state p { color: #999; font-size: 16px; }

  .pagination-wrapper { margin-top: 60px; display: flex; justify-content: center; }
  .pagination { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0; }
  .page-item { margin: 0; }
  .page-link { display: flex; align-items: center; justify-content: center; min-width: 40px; height: 40px; padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 8px; color: #333; text-decoration: none; font-weight: 600; transition: all 0.3s ease; background: white; }
  .page-link:hover { border-color: #0066cc; color: #0066cc; background: #f0f7ff; transform: translateY(-2px); }
  .page-item.active .page-link { background: #0066cc; color: white; border-color: #0066cc; }
  .page-item.disabled .page-link { color: #ccc; border-color: #f0f0f0; cursor: not-allowed; background: #fafafa; }
</style>

<section class="products-section">
  <div class="container" id="productContainer">
    <h2 class="section-title">Women Care</h2>
    <div class="row" id="productRow"></div>

    @if ($medicines->hasPages())
      <div class="pagination-wrapper">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            @if ($medicines->onFirstPage())
              <li class="page-item disabled"><span class="page-link">«</span></li>
            @else
              <li class="page-item"><a class="page-link" href="{{ $medicines->previousPageUrl() }}" rel="prev">«</a></li>
            @endif

            @foreach ($medicines->getUrlRange(1, $medicines->lastPage()) as $page => $url)
              @if ($page == $medicines->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
              @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
              @endif
            @endforeach

            @if ($medicines->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $medicines->nextPageUrl() }}" rel="next">»</a></li>
            @else
              <li class="page-item disabled"><span class="page-link">»</span></li>
            @endif
          </ul>
        </nav>
      </div>
    @endif
  </div>
</section>
@endsection

@push('scripts')
<script>
(function() {
  // Cart UI re-hydrate
  try { window.dispatchEvent(new Event('pageshow')); } catch (_) {}
  setTimeout(() => {
    const badge = document.querySelector('.header-icon .badge-count');
    const bag   = document.querySelector('.cart-badge');
    const total = document.querySelector('.cart-total');
    const currentCount = badge ? parseInt(badge.textContent || '0', 10) || 0 : 0;
    if (currentCount > 0) return;
    try {
      const state = JSON.parse(localStorage.getItem('floatingCartState') || '{"items": []}');
      const sums = (state.items || []).reduce((acc, it) => {
        const qty = Math.max(1, Number(it.quantity) || 0);
        const price = Number(it.price) || 0;
        acc.count += qty; acc.amount += qty * price; return acc;
      }, { count: 0, amount: 0 });
      if (badge) badge.textContent = sums.count;
      if (bag)   bag.innerHTML = `<i class="fas fa-shopping-bag"></i> ${sums.count} ${sums.count===1?'Item':'Items'}`;
      if (total) total.textContent = `৳ ${sums.amount.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2})}`;
    } catch(e) { console.warn('Cart hydrate fallback failed on womenCare page:', e); }
  }, 0);

  let paginatedData = @json($medicines ?? []);
  let products = paginatedData.data || paginatedData;

  const baseUrl = "{{ asset('') }}";
  const productRow = document.getElementById("productRow");
  productRow.innerHTML = '';

  const resolveNumber = typeof window.toFloatingCartNumber === 'function'
    ? window.toFloatingCartNumber
    : (val) => {
        if (val === null || val === undefined) return 0;
        if (typeof val === 'number' && Number.isFinite(val)) return val;
        const parsed = parseFloat(String(val).replace(/[^0-9.\-]/g, ''));
        return Number.isFinite(parsed) ? parsed : 0;
      };

  (products || []).forEach(product => {
    let colDiv = document.createElement("div");
    colDiv.className = "col-lg-3 col-md-4 col-sm-6 mb-4";

    const hasDiscount = product.discount_percentage && product.discount_percentage > 0;
    const discountBadge = hasDiscount ? `<span class="discount-badge">${product.discount_percentage}% OFF</span>` : "";

    const imageUrl  = product.image ? baseUrl + product.image : 'https://via.placeholder.com/400x300?text=No+Image';
    const currPrice = resolveNumber(product.current_price ?? product.price ?? 0);
    const oldPrice  = resolveNumber(product.old_price ?? 0);

    colDiv.innerHTML = `
      <div class="product-card" data-product-id="${product.id}">
        ${discountBadge}
        <img src="${imageUrl}" alt="${product.name}" class="product-img"
             onerror="this.src='https://via.placeholder.com/300x200/e0e0e0/666666?text=Product'">
        <h4 class="product-name">${product.name}</h4>
        <div class="product-price">
          <span class="current-price">৳${currPrice.toFixed(2)}</span>
          ${oldPrice && oldPrice > currPrice ? `<span class="old-price">৳${oldPrice.toFixed(2)}</span>` : ``}
        </div>
        <button class="btn-add-cart">
          <i class="fas fa-shopping-cart"></i><span>Add to Cart</span>
        </button>
      </div>
    `;

    productRow.appendChild(colDiv);

    const addButton = colDiv.querySelector('.btn-add-cart');
    if (addButton) {
      addButton.dataset.productId = product.id !== undefined && product.id !== null ? String(product.id) : '';
      addButton.dataset.productName = product.name ? String(product.name) : '';
      addButton.dataset.productPrice = String(currPrice);
    }
  });

  if (!products || products.length === 0) {
    productRow.innerHTML = `
      <div class="col-12">
        <div class="empty-state">
          <i class="fas fa-box-open"></i>
          <h5>No products available at the moment</h5>
          <p>Please check back later for new arrivals</p>
        </div>
      </div>
    `;
  }

  document.addEventListener('click', (event) => {
    const button = event.target.closest('.btn-add-cart');
    if (!button) return;
    event.preventDefault();

    const card = button.closest('.product-card');
    const productName = (button.dataset.productName || card?.querySelector('.product-name')?.textContent || '').trim() || 'Product';
    const productId   = button.dataset.productId || card?.getAttribute('data-product-id') || productName.toLowerCase().replace(/\s+/g,'-');
    const priceSource = button.dataset.productPrice || card?.querySelector('.current-price')?.textContent || '0';
    const unitPrice   = resolveNumber(priceSource);
    if (unitPrice <= 0) return;

    const add = () => {
      if (typeof window.addToFloatingCart === 'function') {
        window.addToFloatingCart(productId, productName, unitPrice, 'medicine_T');
        button.innerHTML = '<i class="fas fa-check"></i><span>Added</span>';
        button.style.background = 'linear-gradient(135deg,#4CAF50 0%,#45a049 100%)';
        button.style.pointerEvents = 'none';
        setTimeout(() => {
          button.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Add to Cart</span>';
          button.style.background = 'linear-gradient(135deg,#0066cc 0%,#0052a3 100%)';
          button.style.pointerEvents = 'auto';
        }, 1800);
      } else { setTimeout(add, 0); }
    };
    add();
  });

  window.addEventListener('load', function() {
    setTimeout(() => {
      document.querySelectorAll('.product-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
          card.style.transition = 'all 0.5s ease';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, i * 50);
      });
    }, 100);
  });
})();
</script>
@endpush
