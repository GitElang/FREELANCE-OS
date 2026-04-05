<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $project->title }}</title>
    <style>
        body { font-family: sans-serif; }
        .invoice-box {
            border: 5px solid black;
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        .header { border-bottom: 3px solid black; padding-bottom: 20px; margin-bottom: 20px; }
        .title { font-size: 30px; font-weight: bold; text-transform: uppercase; }
        .details { margin-bottom: 40px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 2px solid black; padding: 10px; text-align: left; }
        .table th { background: #eee; }
        .total { font-size: 20px; font-weight: bold; margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="title">INVOICE</div>
            <p><strong>Freelance OS</strong> / Project Management</p>
        </div>

        <div class="details">
            <p><strong>CLIENT:</strong> {{ $project->client->name }}</p>
            <p><strong>DATE:</strong> {{ date('d F Y') }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>IDR {{ number_format($project->budget, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            TOTAL DUE: IDR {{ number_format($project->budget, 0, ',', '.') }}
        </div>
    </div>
</body>
</html>