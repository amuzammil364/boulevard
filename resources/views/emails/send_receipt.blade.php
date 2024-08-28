<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safari Boulevard - Data Management System</title>
</head>

<body>

<div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 2.5rem;">
    <div style="border-bottom: 2px solid #E5E7EB; text-align: center; padding-bottom: 0.75rem;">
        <img src="https://portal.stackhub.pro/images/logo-vertical.png" width="150" alt="Logo" style="max-width: 100%; height: auto;">
        <p style="font-weight: bold; font-size: 1.25rem; margin-top: 0.5rem; margin-bottom: 0; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; text-transform: uppercase; color: #000;">Residents Welfare Association</p>
        <p style="font-size: 0.875rem; line-height: 1.25rem; margin: 0; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; color: #000;">(Reg.No. Karachi-700/1999)</p>
        <p style="font-size: 0.875rem; line-height: 1.25rem; margin: 0; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; color: #000;">Scheme No.36 Fl-11/12, Block 15, Gulistan-e-jauhar</p>
    </div>
    <div style="padding-top: 2.25rem; padding-left: 3rem; padding-right: 3rem;">
    <table style="font-size: 0.875rem; line-height: 1.25rem; text-align: left; width: 100%; border-collapse: collapse; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">
        <thead style="color: #000; text-transform: uppercase;">
            <tr>
                <th scope="col" class="" style="color: #000;">
                    <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Month:</strong> {{ $data['month'] }}
                </th>
                <th scope="col" class="" style="color: #000;">
                    <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Date:</strong> {{ $data['date'] }}
                </th>
            </tr>
            <tr>
                <th scope="col" class="" style="color: #000;">
                    <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Flat:</strong> {{ $data['flat'] }}
                </th>
                <th scope="col" class="" style="color: #000;">
                    <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Receipt ID:</strong> {{ $data['receipt_id'] }}
                </th>
            </tr>
            <tr class="">
                <th scope="col" class="" style="color: #000;">
                    <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Phase:</strong>  {{ $data['phase'] }}
                </th>
                <th scope="col" class="" style="color: #000;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ url("/dashboard/view-receipt?pid=$payment_id") }}&amp;size=100x100" alt="" title="">
                </th>
            </tr>
        </thead>
        <tbody style="display: inline-grid">
            <tr style="display: inline-block; margin-top: 0.25rem;">
                <th style="text-transform: uppercase; white-space: nowrap; color: #000;">
                <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Resident:</strong>
                    {{ $data['resident'] }}
                </th>
            </tr>
            <tr style="display: inline-block; margin-top: 0.25rem;">
                <th style="text-transform: uppercase; white-space: nowrap; color: #000;">
                <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Contact:</strong>
                    {{ $data['contact'] }}
                </th>
            </tr>
            <tr style="display: inline-block; margin-top: 0.25rem;">
                <th style="text-transform: uppercase; white-space: nowrap; color: #000;">
                <strong style="font-weight: bolder; color: rgba(25, 182, 175, 1);">Payment Id:</strong>
                    {{ $data['payment_id'] }}
                </th>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 1rem; font-size: 0.875rem; line-height: 1.25rem;text-align: left; width: 100%; border-collapse: collapse; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">
        <thead>
            <tr>
                <th style="text-transform: uppercase; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border: 1px solid #6B7280; color: #000;">
                    Item
                </th>
                <th style="text-transform: uppercase; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border: 1px solid #6B7280; color: #000;">
                    Amount
                </th>
            </tr>
        </thead>

        <tbody>
                @foreach ($data['receipt_items'] as $key=>$value)
                <tr>
                    <th style="text-transform: uppercase; font-weight: 700; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border: 1px solid #6B7280; color: #000;">
                        {{ $key }}
                    </th>
                    <td style="text-transform: uppercase; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border: 1px solid #6B7280; color: #000;">{{ $value }} PKR</td>
                </tr>
                @endforeach
             <tr>
                <th style="text-transform: uppercase; font-weight: 700; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; color: #000;">
                    Total Amount Received
                </th>
                <td style="text-transform: uppercase; font-size: 0.75rem; line-height: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border: 1px solid #6B7280; color: #000;">{{ $total }} PKR</td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 5rem; text-align: center; border-top: 2px solid #E5E7EB; border-bottom: 2px solid #E5E7EB; color: #000;">
        <p style="margin: 0; color: rgb(31 41 55 / 1); font-size: 0.875rem; line-height: 1.25rem; padding-top: 0.5rem; padding-bottom: 0.5rem; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; color: #000;">This is a digitally generated receipt, does not require signature</p>
    </div>
    </div>
    {{-- <div style="padding-top: 30px; padding-left: 20px;">
        <p><strong>Month:</strong> {{ $data['month'] }}</p>
        <p><strong>Date:</strong> {{ $data['date'] }}</p>
        <p><strong>Flat:</strong> {{ $data['flat'] }}</p>
        <p><strong>Receipt ID:</strong> {{ $data['receipt_id'] }}</p>
        <p><strong>Phase:</strong>{{ $data['phase'] }}</p>
    </div>
    <div style="padding-top: 30px; padding-left: 20px;">
        <p><strong>Resident:</strong> {{ $data['resident'] }}</p>
        <p><strong>Contact:</strong> {{ $data['contact'] }}</p>
        <p><strong>Payment ID:</strong> {{ $data['payment_id'] }}</p>
    </div>
    <div style="padding-top: 30px; padding-left: 20px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background-color: #fff;">
                <th style="border: 1px solid #333; padding: 5px;">Item</th>
                <th style="border: 1px solid #333; padding: 5px;">Amount</th>
            </tr>
            @foreach ($data['receipt_items'] as $key=>$value)
                <tr style="background-color: #fff;">
                    <td style="border: 1px solid #333; padding: 5px; font-weight: bold;">{{ $key }}</td>
                    <td style="border: 1px solid #333; padding: 5px;">{{ $value }} PKR</td>
                </tr>
            @endforeach
            <tr style="background-color: #fff;">
                <td style="border: 1px solid #333; padding: 5px; font-weight: bold;">Total</td>
                <td style="border: 1px solid #333; padding: 5px;">{{ $value }} PKR</td>
            </tr>
        </table>
    </div>
    <div style="padding-top: 20px; text-align: center; border-top: 2px solid #333; border-bottom: 2px solid #333;">
        <p style="font-size: 0.8rem; padding: 10px 0;">This is a digitally generated receipt, does not require signature</p>
    </div> --}}
</div>

</body>
</html>