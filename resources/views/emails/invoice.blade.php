<div style="font-family: sans-serif; padding: 20px; border: 10px solid black;">
    <h1 style="text-transform: uppercase;">Invoice Project</h1>
    <p>Halo <strong>{{ $project->client->name }}</strong>,</p>
    <p>Terima kasih telah bekerja sama. Berikut adalah detail tagihan untuk project:</p>
    
    <div style="background: #f0f0f0; padding: 15px; border: 2px solid black;">
        <h2 style="margin: 0;">{{ $project->title }}</h2>
        <p style="font-size: 20px; font-weight: bold;">Total: IDR {{ number_format($project->budget, 0, ',', '.') }}</p>
    </div>

    <p>Mohon segera melakukan pembayaran sesuai kesepakatan.</p>
    <p>Salam,<br><strong>Freelance OS</strong></p>
</div>