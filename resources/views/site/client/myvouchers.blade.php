@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
    <style>
        a {
            text-decoration: none;
        }
        a:hover {
        text-decoration: none; /* Remove underline on hover */
    }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4; font-size: 25px" class="alert text-center alert-primary font-weight-bold text-dark">
                My Vouchers
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="/parent/voucher/rewards">
                    <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                        <i class="fas fa-gift fa-fw"></i> Claim Rewards
                    </div>
                </a>
                </div>
                <div class="col-md-6">
                    <a href="/parent/voucher/my_vouchers">
                    <div class="alert alert-success font-weight-bold text-dark text-center">
                        <i class="fas fa-receipt fa-fw"></i>My Vouchers
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">My Vouchers</h6>
        </div>
        <div class="col-md-12">
            @if ($my_vouchers->isEmpty())
                <div class="alert alert-warning">
                    No vouchers available as of this moment
                </div>
            @elseif(!$my_vouchers->isEmpty())

                    <div class="row">
                        @foreach ($my_vouchers as $my_voucher)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                {{ $my_voucher->voucherType->partners->name }}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $my_voucher->voucherType->item_name }}
                                            </div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                @if ($my_voucher->is_redeemed == 1)
                                                    <span class="text-secondary mr-2">CLAIMED AT</span>
                                                    <span>{{ $my_voucher->redeemed_at }}</span>
                                                @elseif($my_voucher->is_redeemed == 0)
                                                    <span class="text-success mr-2">NOT YET CLAIMED</span>
                                                @endif
                                                <br>
                                                <span class="text-uppercase">{{ $my_voucher->infant->infant_firstname }} {{ $my_voucher->infant->infant_lastname }}</span>
                                                <br>
                                                <span class="text-success" style="font-size: 20px;" id="voucher-code-{{ $my_voucher->id }}">
                                                    ***********
                                                </span>
                                                <span class="ml-2">
                                                    <i class="fas fa-eye-slash" id="toggle-eye-{{ $my_voucher->id }}" onclick="toggleVoucherCode({{ $my_voucher->id }})" style="cursor: pointer;"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                        function toggleVoucherCode(id) {
                            var voucherCodeElement = document.getElementById('voucher-code-' + id);
                            var eyeIcon = document.getElementById('toggle-eye-' + id);
                            if (voucherCodeElement.textContent.includes('*')) {
                                // Reveal the voucher code
                                voucherCodeElement.textContent = "{{ $my_voucher->voucher_code }}"; // Adjust this to pass the actual voucher code dynamically if needed
                                eyeIcon.classList.remove('fa-eye-slash');
                                eyeIcon.classList.add('fa-eye');
                            } else {
                                // Hide the voucher code
                                voucherCodeElement.textContent = '*************';
                                eyeIcon.classList.remove('fa-eye');
                                eyeIcon.classList.add('fa-eye-slash');
                            }
                        }
                        </script>

                        @endforeach
                        {{-- end of voucher line --}}
                    </div>

            @endif
        </div>
    </div>
    @if (session('success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Voucher Claimed',
                    message: 'The voucher has been claimed successfully',
                });
            };
        </script>
    @endif
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
