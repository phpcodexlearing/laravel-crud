<div class="modal" id="myModalView">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Product Details</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal Body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3 col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Title:</label>
                <p>{{ $product->title ?? 'N/A' }}</p>
              </div>
  
              <div class="form-group mb-3">
                <label class="form-label">Type:</label>
                <p>{{ ucfirst($product->type) ?? 'N/A' }}</p>
              </div>
  
              <div class="form-group mb-3">
                <label class="form-label">Tags:</label>
                <p>
                  @php
                    $tagsArray = isset($product->tags) ? explode(',', $product->tags) : [];
                  @endphp
                  {{ implode(', ', $tagsArray) ?: 'N/A' }}
                </p>
              </div>
  
              <div class="form-group mb-3">
                <label class="form-label">Price:</label>
                <p>{{ isset($product->product_price) ? number_format($product->product_price, 2) : 'N/A' }}</p>
              </div>
            </div>
  
            <div class="col-sm-3 col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Category:</label>
                <p>{{ $product->category->name ?? 'N/A' }}</p>
              </div>
  
              <div class="form-group mb-3">
                <label class="form-label">Subcategory:</label>
                <p>{{ $product->subCategory->name ?? 'N/A' }}</p>
              </div>
  
              <div class="form-group mb-3">
                <label class="form-label">Product Images:</label>
                <div>
                  @if(isset($product->image_path))
                    
                    <img src="{{ asset($product->image_path) }}" alt="Product Image" class="img-fluid">
                    <br>
                    <br>
                    <img src="{{ asset($product->thumbnail_path) }}" alt="Product Image" class="img-fluid">
                  @else
                    <p>No image available</p>
                  @endif
                </div>
              </div>
            </div>
  
            <div class="col-sm-3 col-md-12">
              <div class="form-group mb-3">
                <label class="form-label">Description:</label>
                <p>{!! $product->description !!}</p>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
