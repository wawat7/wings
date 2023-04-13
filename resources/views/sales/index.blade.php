@extends('layouts.master-layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sales</h1>

    <!-- DataTales Example -->
    @include('sales.partials.products')
    @include('sales.partials.cart')

    @push('script')

    <script>

        const userId = "{{ auth()->user()->id }}";


        function getDetail(productId) {
            console.log(productId);
            getProductById(productId);
            $('#productDetailModal').modal('show');
        }

        function getProductById(productId) {
            $.get("/api/products/" + productId, function(data, status){
                if (status === 'success') {
                    $('#product-name').html(data.name);
                    $('#product-price').html(data.price);
                    $('#product-price-discount').html(data.price_discount);
                    $('#product-dimension').html(data.dimension);
                    $('#product-unit').html(data.unit);
                    $('#product-id').val(data.id);
                }
            });
        }

        $('#add-to-cart').click(function(e) {
            const productId = $('#product-id').val();
            addToCart(productId, userId);
            $('#productDetailModal').modal('hide');
            getCarts(userId);
        })

        function addToCart(productId, userId) {
            $.ajax({
                type: 'POST',
                url: '/api/carts',
                contentType: 'application/json',
                data: JSON.stringify({
                    product_id: productId,
                    user_id: userId,
                    quantity: 1
                }),
            }).done(function () {
                console.log('SUCCESS');
            }).fail(function (msg) {
                console.log('FAIL');
            }).always(function (msg) {
                console.log('ALWAYS');
            });
        }

        getCarts(userId);
        function getCarts(userId) {
            const url = "/api/carts?user_id=" + userId;
            $.get(url, function(data, status){
                if (status === 'success') {
                    $('#body-table-cart').empty();
                    $('#body-table-cart').append(mapCartToHtml(data));
                    $('#grand-total-cart').html(grandTotalCart(data));
                }
            });
        }

        function mapCartToHtml(carts) {
            let html = '';

            if (carts.length == 0) {
                html += `
                        <tr align="center">
                            <td colspan="5">No Data</td>
                        </tr>
                `;
            } else {
                carts.forEach(cart => {
                    html += `
                            <tr>
                                <td>${cart.product_name}</td>
                                <td>Rp. <s>${cart.product_price}</s> ${cart.product_price_discount}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm update-qty" onclick="updateQty(${cart.id},${cart.quantity - 1})">-</button>
                                    ${cart.quantity}
                                    <button class="btn btn-primary btn-sm  update-qty" onclick="updateQty(${cart.id},${cart.quantity + 1})">+</button>
                                </td>
                                <td>${cart.sub_total}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" onclick="removeCart(${cart.id})">DELETE</a>
                                </td>
                            </tr>
                    `;
                });
            }

            return html;
        }

        function grandTotalCart(carts) {
            let grandTotal = 0;
            carts.forEach(cart => {
                grandTotal += cart.sub_total;
            });

            return grandTotal;
        }

        function removeCart(cartId) {
            deleteCartById(cartId);
            getCarts(userId);
        }

        function deleteCartById(cartId) {
            $.ajax({
                type: 'DELETE',
                url: '/api/carts/' + cartId,
            }).done(function () {
                console.log('SUCCESS');
            }).fail(function (msg) {
                console.log('FAIL');
            }).always(function (msg) {
                console.log('ALWAYS');
            });
        }

        function updateQty(cartId, qty) {
            updateCartById(cartId, qty);
            getCarts(userId);
        }

        function updateCartById(cartId, qty) {
            $.ajax({
                type: 'PUT',
                url: '/api/carts/' + cartId,
                contentType: 'application/json',
                data: JSON.stringify({
                    quantity: qty,
                }),
            }).done(function () {
                console.log('SUCCESS');
            }).fail(function (msg) {
                console.log('FAIL');
            }).always(function (msg) {
                console.log('ALWAYS');
            });
        }
    </script>

    <script>

    </script>
    @endpush
@endsection
