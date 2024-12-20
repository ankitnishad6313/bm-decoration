<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .email-container {
            max-width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
        }

        .header {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }
        
        table{
            width: 100%;
            overflow: scroll;
        }

        .order-details {
            margin: 20px 0;
        }

        .order-item {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Order Confirmation</h1>
        </div>
        <div class="order-details">
            <h2>Order Summary</h2>
            <table class="table text-start text-nowrap align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sr. No.</th>
                        <th scope="col">Customer Detail</th>
                        {{-- <th scope="col">Product Image</th> --}}
                        <th scope="col">Product Name</th>
                        <th scope="col">Decoration Date/Decoration Time</th>
                        <th scope="col">Addon Products</th>
                        <th scope="col">Address</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Order Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach ($mailData as $key => $item)
                        <tr>
                            <th>{{ ++$key }}</th>
                            <th>
                                <span class="d-block"><b>{{ $item->name }}</b></span>
                                <span class="d-block"><a
                                        href="mailto:{{ $item->email }}">{{ $item->email }}</a></span>
                                <span class="d-block"><a
                                        href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></span>
                            </th>
                            {{-- <td><img src="{{ url('/uploads/products/' . $item->product->thumb_img) }}" alt=""
                                    height="100" width="100"></td> --}}
                            <td>
                                <span class="d-block">{{ $item->product->name }}</span>
                                <span class="d-block">Price : ₹ {{ $item->product->discount_price }}</span>
                            </td>
                            <td>
                                <span class="d-block">Date: <b
                                        class="text-danger">{{ formateDate('d-F-Y', $item->date) }}</b></span>
                                <span class="d-block">Time: <b class="text-danger">{{ $item->time }}</b></span>
                            </td>
                            <td>
                                @if (!empty($item->addon_id))
                                    <table class="table table-borderd">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Name</th>
                                                {{-- <th>Image</th> --}}
                                                <th>Quantity / Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->addon_id as $sr => $addon)
                                                @php
                                                    $addondata = getAddonItem($addon);
                                                @endphp
                                                <tr>
                                                    <td>{{ $sr + 1 }}</td>
                                                    <td>{{ $addondata->name }}</td>
                                                    {{-- <td><img src="{{ url('/uploads/addon/' . $addondata->image) }}"
                                                            alt=""></td> --}}
                                                    <td>{{ $item->addon_quantity[$sr] . ' / ₹ ' . $item->addon_price[$sr] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </td>
                            <td>
                                <span class="d-block">City: <b class="text-danger">{{ $item->city }}</b></span>
                                <span class="d-block">State: <b class="text-danger">{{ $item->user->state }}</b></span>
                                <span class="d-block">Pincode: <b
                                        class="text-danger">{{ $item->pincode }}</b></span>
                                <span class="d-block">Address:
                                    <b class="text-danger">
                                        {{ $item->current_address }}
                                    </b>
                                </span>
                                <span class="d-block">Landmark:
                                    <b class="text-danger">
                                        {{ $item->landmark }}
                                    </b>
                                </span>
                            </td>
                            <td>{{ ucfirst($item->payment_status) }}</td>
                            <td>₹ {{ $item->total_amount }}</td>
                            <td>{{ formateDate('d-M-Y h:i A', $item->updated_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>

</html>
