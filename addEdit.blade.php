<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Action</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
        <form id="commentForm" action="{{ route('product.add.edit') }}" enctype="multipart/form-data">
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="token" value="{{ $product->id ?? '' }}">
               

                <div class="row">
                  <div class="col-sm-3 col-md-6">
                    <div class="form-group  mb-3 ">
                      <label for="title" class="form-label">title:</label>
                      <input type="text" value="{{ $product->title ?? '' }}" class="form-control" id="title" placeholder="Enter title" name="title" required>
                      <label id="title-error" class="error" for="title" style="display: none;"></label>
                    </div> 
                    <div class="form-group mb-3 ">
                      <label for="type" class="form-label">Type</label>
                        <select class="js-example-basic-single form-control" required name="type" id="type" >
                        <option value="">Select Type</option>
                        <option value="male" {{ isset($product->type) && $product->type == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ isset($product->type) && $product->type == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <label id="type-error" class="error" for="type" style="display: none;"></label>
                    </div>  
                    <div class="form-group mb-3 ">
                      @php
                            if(isset($product->tags) && $product->tags){
                                $tagsArray = explode(',', $product->tags);
                            }
                          @endphp
                        <label class="form-label">Tags : </label>
                        <br>
                        <input type="checkbox" class="form-check-input" required id="tag1" name="tags[]" value="Tag 1" {{ isset($product->tags) && in_array('Tag 1', $tagsArray) ? 'checked' : '' }}>
                        <label for="tag1">Tag 1</label>
                        <input type="checkbox" class="form-check-input" required id="tag2" name="tags[]" value="Tag 2" {{ isset($product->tags) && in_array('Tag 2', $tagsArray) ? 'checked' : '' }}>
                        <label for="tag2">Tag 2</label>
                        <input type="checkbox" class="form-check-input" required id="tag3" name="tags[]"  value="Tag 3" {{ isset($product->tags) && in_array('Tag 3', $tagsArray) ? 'checked' : '' }}>
                        <label for="tag3">Tag 3</label>
                        <input type="checkbox" class="form-check-input" required id="tag4" name="tags[]"  value="Tag 4" {{ isset($product->tags) && in_array('Tag 4', $tagsArray) ? 'checked' : '' }}>
                        <label for="tag4">Tag 4</label>
                        <input type="checkbox" class="form-check-input" required id="none" name="tags[]"  value="None" {{ isset($product->tags) && in_array('None', $tagsArray) ? 'checked' : '' }}>
                        <label for="none">None</label>
                        <br>
                        <label id="tags[]-error" class="error" for="tags[]" style="display: none;"></label>
                    </div>  
                      <div class="form-group mb-3 ">
                        <label for="product_price" class="form-label">Price</label>
                        <input type="number" required class="form-control" id="product_price" name="product_price" step="0.01" value="{{ isset($product->product_price) ? $product->product_price : '' }}">
                        <label id="product_price-error" class="error" for="product_price" style="display: none;"></label>
                      </div>
                  </div>

                  <div class="col-sm-3 col-md-6">
                    <div class="form-group mb-3 ">
                        <label for="category_id" class="form-label">Category </label>
                        <select class="js-example-basic-single form-control" data-action={{ route('fetch.category') }} name="category_id" id="category_id" required>
                          <option value="">Select a category</option> 
                          @if(isset($product->category) && $product->category->name)
                          <option selected value="{{ $product->category_id }}">{{ $product->category->name }}</option>  
                          @endif
                      </select>
                        <label id="category_id-error" class="error" for="category_id" style="display: none;"></label>
                    </div>
                  
                    <div class="form-group mb-3 ">
                        <label for="subcategory_id" class="form-label">Sub Category</label>
                        <select class="js-example-basic-single form-control" data-action={{ route('fetch.subcategory') }} name="subcategory_id" id="subcategory_id" required>
                          <option value="">Select a sub category</option>  
                          @if(isset($product->subCategory) && $product->subCategory->name)
                          <option selected value="{{ $product->sub_category_id }}">{{ $product->subCategory->name }}</option>  
                          @endif
                      </select>
                        <label id="subcategory_id-error" class="error" for="subcategory_id" style="display: none;"></label>
                    </div>

                    <div class="form-group mb-3 ">
                      <label for="title" class="form-label">Product Images:</label>
                      <input type="file" class="form-control" id="image_path" name="image_path"  @if(!isset($product->id)) required @endif >
                      <label id="image_path-error" class="error" for="image_path" style="display: none;"></label>
                    </div>  
                  </div>

                 

                  <div class="col-sm-3 col-md-6">
                    
                  </div>

                  <div class="col-sm-3 col-md-6">
                   
                  </div>

                  

                  <div class="col-sm-3 col-md-6">
                  
                  </div>

                  <div class="col-sm-3 col-md-6">
                    
                  </div>

                  <div class="col-sm-3 col-md-12">
                    <div class="form-group mb-3 ">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" rows="3" required name="description">{{ isset($product->description) ? $product->description : '' }}</textarea>
                        <label id="description-error" class="error" for="description" style="display: none;"></label>
                    </div>
                  </div>

                


                </div>
                        
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary check_click" >Submit</button>
            </div>
        </form>

    </div>
  </div>
</div>

<script src="{{ asset('js/custom_js.js') }}"></script>
