<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yangi forma yuborildi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
        }
        .field-label {
            font-weight: bold;
            color: #495057;
        }
        .field-value {
            margin-top: 5px;
            color: #212529;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Yangi forma yuborildi</h2>
        <p>Veb-saytdan yangi xabar keldi:</p>
    </div>

    <div class="field">
        <div class="field-label">Ism:</div>
        <div class="field-value">{{ $formData['name'] }}</div>
    </div>

    <div class="field">
        <div class="field-label">Telefon:</div>
        <div class="field-value">{{ $formData['phone'] }}</div>
    </div>

    <div class="field">
        <div class="field-label">Email:</div>
        <div class="field-value">{{ $formData['email'] }}</div>
    </div>

    <div class="field">
        <div class="field-label">Izoh:</div>
        <div class="field-value">{{ $formData['comment'] }}</div>
    </div>

    <hr style="margin: 30px 0; border: none; border-top: 1px solid #dee2e6;">
    <p style="color: #6c757d; font-size: 12px;">
        Bu xabar {{ now()->format('d.m.Y H:i') }} da yuborilgan.
    </p>
</body>
</html>
