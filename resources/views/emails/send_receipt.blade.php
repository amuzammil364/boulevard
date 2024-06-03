<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safari Boulevard - Data Management System</title>
</head>

<body>

<div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 10px;">
    <div style="border-bottom: 2px solid #333; text-align: center; padding-bottom: 20px;">
        <img src="https://portal.stackhub.pro/images/logo-vertical.png" alt="Logo" style="max-width: 100%; height: auto;">
        <p style="font-weight: bold; font-size: 1.5rem; margin-top: 10px;">Residents Welfare Association</p>
        <p style="font-size: 0.8rem;">(Reg.No. Karachi-700/1999)</p>
        <p style="font-size: 0.8rem;">Scheme No.36 Fl-11/12, Block 15, Gulistan-e-jauhar</p>
    </div>
    <div style="padding-top: 30px; padding-left: 20px;">
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
    </div>
</div>

</body>
</html>