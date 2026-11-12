<x-front-layout :title="__('Order Details')">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">
                                {{ __('Order Details') }}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li><a href="#">{{ __('Orders') }}</a></li>
                            <li>
                                <span style="font-family: 'Courier New', Courier, monospace; letter-spacing: 1.5px; font-weight: bold;">
                                    #{{ chunk_split($order->number, 4, ' ') }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <style>
        .tracking-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #eef2f6;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .info-box-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .pulse-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 1.8s infinite;
        }

        @keyframes pulse-green {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        #map {
            height: 100%;
            min-height: 480px;
            border-radius: 16px;
            z-index: 1;
        }

        .custom-leaflet-marker {
            background: transparent !important;
            border: none !important;
        }

        .order-step {
            display: flex;
            align-items: flex-start;
            position: relative;
            padding-bottom: 20px;
        }

        .order-step:last-child {
            padding-bottom: 0;
        }

        .order-step::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 30px;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        [dir="rtl"] .order-step::before {
            left: auto;
            right: 15px;
        }

        .order-step:last-child::before {
            display: none;
        }

        .step-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            z-index: 2;
            margin-right: 15px;
        }

        [dir="rtl"] .step-icon {
            margin-right: 0;
            margin-left: 15px;
        }

        .order-step.active .step-icon {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }
    </style>

    <section class="checkout-wrapper section py-5" style="background-color: #f8fafc;">
        <div class="container">

            <x-alert type="success" />

            <div class="tracking-card p-4 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="info-box-icon" style="background-color: rgba(37, 99, 235, 0.1); color: #2563eb;">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-7 d-block">{{ __('Order Number') }}</span>
                                <h4 class="mb-0 fw-bold" style="color: #0f172a; font-family: 'Courier New', Courier, monospace; letter-spacing: 1.5px;">
                                    #{{ chunk_split($order->number, 4, ' ') }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-md-end">
                        @if (in_array($order->status, ['delivering', 'in_transit']))
                        <div class="pulse-badge">
                            <span class="pulse-dot"></span>
                            {{ __('Live Courier Tracking') }}
                        </div>
                        @else
                        <span class="badge bg-secondary px-3 py-2 fs-7">{{ __($order->status) }}</span>
                        @endif

                        @if (in_array($order->status, ['pending', 'processing']))
                        <button type="button" class="btn btn-sm text-danger fw-semibold d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 border-0"
                            style="background-color: rgba(239, 68, 68, 0.08); transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.18)'"
                            onmouseout="this.style.backgroundColor='rgba(239, 68, 68, 0.08)'" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                            <i class="fa-solid fa-circle-xmark fs-6"></i>
                            <span>{{ __('Cancel Order') }}</span>
                        </button>
                        @endif


                        @if (in_array($order->status, ['pending', 'processing']))
                        <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                    <div class="modal-body p-4 text-center">
                                        <div class="mb-3">
                                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger p-3" style="width: 64px; height: 64px;">
                                                <i class="fa-solid fa-triangle-exclamation fs-3"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold mb-2">{{ __('Cancel Order?') }}</h5>
                                        <p class="text-muted mb-4 fs-6">
                                            {{ __('Are you sure you want to cancel this order? This action cannot be undone.') }}
                                        </p>

                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-light px-4 py-2 rounded-3 fw-semibold text-muted" data-bs-dismiss="modal">
                                                    {{ __('Keep Order') }}
                                                </button>
                                                <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold">
                                                    {{ __('Yes, Cancel It') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (in_array($order->status, ['delivering', 'in_transit']))
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-12">
                    <div class="tracking-card p-4 mb-4">
                        <h6 class="text-muted text-uppercase fw-semibold mb-3 fs-7">{{ __('Delivery Status') }}</h6>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 id="delivery-status" class="text-primary fw-bold mb-0">
                                {{ __($delivery?->status ?? 'In Transit') }}
                            </h4>
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                style="background-color: rgba(37, 99, 235, 0.1); color: #2563eb; width: 42px; height: 42px; font-size: 18px;" title="{{ __($delivery?->status ?? 'Status Unknown') }}">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-card p-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="info-box-icon" style="background-color: rgba(22, 163, 74, 0.1); color: #16a34a;">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <h6 class="fw-bold mb-0 text-dark">{{ __('Delivery Address') }}</h6>
                        </div>
                        <p class="mb-1 text-dark fw-medium">
                            {{ $order->shippingAddress?->street_address ?? __('No street specified') }}
                        </p>
                        <p class="text-muted small mb-0">
                            {{ $order->shippingAddress?->city }}, {{$order->shippingAddress?->country }}
                        </p>
                    </div>

                    <div class="tracking-card p-4">
                        <h6 class="fw-bold mb-4 text-dark fs-6">{{ __('Order Progress') }}</h6>

                        <div class="order-step active">
                            <div class="step-icon"><i class="lni lni-checkmark"></i></div>
                            <div>
                                <h6 class="mb-0 fw-semibold fs-7">{{ __('Order Confirmed') }}</h6>
                                <small class="text-muted">{{ __('Your order has been placed') }}</small>
                            </div>
                        </div>

                        <div class="order-step active">
                            <div class="step-icon"><i class="lni lni-delivery"></i></div>
                            <div>
                                <h6 class="mb-0 fw-semibold fs-7">{{ __('Out for Delivery') }}</h6>
                                <small class="text-muted">{{ __('Courier is on the way') }}</small>
                            </div>
                        </div>

                        <div class="order-step">
                            <div class="step-icon"><i class="lni lni-home"></i></div>
                            <div>
                                <h6 class="mb-0 fw-semibold fs-7">{{ __('Delivered') }}</h6>
                                <small class="text-muted">{{ __('Order delivered successfully') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-12">
                    <div class="tracking-card p-2 h-100 shadow-sm" style="min-height: 500px;">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            @endif

            <div class="tracking-card p-4">
                <h5 class="fw-bold mb-4 text-dark fs-6"><i class="fa-solid fa-list-check me-2 text-primary"></i>{{ __('Order Items') }}</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th class="text-center">{{ __('Price') }}</th>
                                <th class="text-center">{{ __('Quantity') }}</th>
                                <th class="text-end">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->product &&$item->product->image_url)
                                        <img src="{{ $item->product->image_url }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-semibold fs-7">{{ $item->product_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ Currency::format($item->price) }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">{{ Currency::format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold fs-6">{{ __('Total Amount') }}:</td>
                                <td class="text-end fw-bold text-primary fs-6">{{ Currency::format($order->total) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>

    @if (in_array($order->status, ['delivering', 'in_transit']))
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

                var customerLat = "{{ $order->shippingAddress?->latitude }}";
                var customerLng = "{{ $order->shippingAddress?->longitude }}";
                var fullAddress = "{{ $order->shippingAddress?->street_address }}, {{ $order->shippingAddress?->city }}, {{$order->shippingAddress?->country }}";

                var courierLocation = [
                    Number("{{ $delivery?->latitude ?? 31.0409 }}"),
                    Number("{{ $delivery?->longitude ?? 31.3785 }}")
                ];

                var customerLocation = null;
                var polyline = null;

                var map = L.map('map').setView(courierLocation, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                var customerIcon = L.divIcon({
                    html: `<div style="font-size:22px; background:#ffffff; width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(0,0,0,0.15); border:3px solid #2563eb;">🏠</div>`,
                    className: 'custom-leaflet-marker',
                    iconSize: [42, 42],
                    iconAnchor: [21, 21]
                });

                var courierIcon = L.divIcon({
                    html: `<div style="font-size:22px; background:#ffffff; width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(0,0,0,0.15); border:3px solid #16a34a;">🏍️</div>`,
                    className: 'custom-leaflet-marker',
                    iconSize: [42, 42],
                    iconAnchor: [21, 21]
                });

                var courierPopupText = "{{ __('Courier is on the way') }} 🏍️";
                var courierMarker = L.marker(courierLocation, {
                        icon: courierIcon
                    })
                    .addTo(map)
                    .bindPopup("<b>" + courierPopupText + "</b>");

                function initCustomerMarker(coords) {
                    customerLocation = coords;
                    var customerPopupText = "{{ __('Delivery Address') }} 🏠";

                    L.marker(customerLocation, {
                            icon: customerIcon
                        })
                        .addTo(map)
                        .bindPopup("<b>" + customerPopupText + "</b><br>" + fullAddress);

                    polyline = L.polyline([courierLocation, customerLocation], {
                        color: '#2563eb',
                        weight: 4,
                        dashArray: '8, 8'
                    }).addTo(map);

                    map.fitBounds(L.latLngBounds([courierLocation, customerLocation]), {
                        padding: [60, 60]
                    });
                }

                if (customerLat && customerLng) {
                    initCustomerMarker([Number(customerLat), Number(customerLng)]);
                } else {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                initCustomerMarker([Number(data[0].lat), Number(data[0].lon)]);
                            } else {
                                initCustomerMarker(courierLocation);
                            }
                        })
                        .catch(() => initCustomerMarker(courierLocation));
                }

                Pusher.logToConsole = true;

                var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                    cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
                    channelAuthorization: {
                        endpoint: "/broadcasting/auth",
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}"
                        }
                    }
                });

                var channel = pusher.subscribe('private-Deliveries.{{ $order->id }}');

                channel.bind('location-updated', function(data) {
                    var newLat = Number(data.lat || data.latitude);
                    var newLng = Number(data.lng || data.longitude);
                    courierLocation = [newLat, newLng];

                    courierMarker.setLatLng(courierLocation);

                    if (polyline && customerLocation) {
                        polyline.setLatLngs([courierLocation, customerLocation]);
                    }

                    map.panTo(courierLocation, {
                        animate: true,
                        duration: 1.0
                    });

                    if (data.status) {
                        var statusElement = document.getElementById('delivery-status');
                        if (statusElement) {
                            statusElement.innerText = data.status;
                        }
                    }
                });

            });
    </script>
    @endif

</x-front-layout>