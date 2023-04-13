<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp <s>{{ $product->price }}</s> {{ $product->price_discount }}</td>
                            <td>
                                <button type="button" onclick="getDetail({{ $product->id }})" class="btn btn-success btn-sm">
                                    BUY
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 id="product-name">NAMA PRODUCT</h2>
                <p><s>Rp. <span id="product-price">900000</span></s></p>
                <h3>Rp. <span id="product-price-discount">8000</span></h3>
                <p>Dimension : <span id="product-dimension">10 X 10 cm</span></p>
                <p>Price Unit : <span id="product-unit">PCS</span></p>
                <input type="hidden" id="product-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-to-cart">Add to cart</button>
            </div>
        </div>
    </div>
</div>
