@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ route('subscription.store') }}" class="form-horizontal" id="payment-form">
                            {{csrf_field()}}

                            <div class="form-group{{$errors->has('plan') ? 'has-error' : ''}}">
                                <label for="plan" class="col-md-4 control-label">Plan</label>

                                <div class="col-md-6">
                                    <select name="plan" id="plan" class="form-control">
                                        @foreach($plans as $plan)
                                            <option value="{{$plan->gateway_id}}" {{request('plan')===$plan->slug
                                                || old('plan') === $plan-> gateway_id ?
                                             'selected="selected"':''}}>{{$plan->name}}({{$plan->price}})</option>
                                        @endforeach
                                    </select>
                                    @if($errors ->has('plan'))
                                    <span role="help-block">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('coupon') ? 'has-error' : ''}}">
                                <label for="coupon" class="col-md-4 control-label">Coupon</label>

                                <div class="col-md-6">
                                    <input type="text" name="coupon" id="coupon" class="form-control" value="{{old('coupon')}}">
                                    @if($errors ->has('coupon'))
                                        <span  role="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="pay" class="btn btn-primary">
                                        Pay
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
        let handler = StripeCheckout.configure({
            key: 'pk_test_6pRNASCoBOKtIshFeQd4XMUh',
            locale: 'auto',
            token: function (token) {
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
                $("#stripeToken").val(token.id);
                $("#stripeEmail").val(token.email);
                $("#myForm").submit();
            }
        });

        $('#customButton').on('click', function (e) {
            // Open Checkout with further options
            handler.open({
                name: 'Stripe.com',
                description: '2 widgets',
                amount: 2000
            });
            e.preventDefault();
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function () {
            handler.close();
        });
    </script>
@endsection
