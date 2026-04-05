<div style="font-family: 'Plus Jakarta Sans', sans-serif; border: 8px solid black; padding: 40px; max-width: 600px; margin: auto; background-color: white;">
    <h1 style="text-transform: uppercase; font-weight: 900; font-style: italic; border-bottom: 4px solid black; padding-bottom: 10px;">
        Project Approved! 🚀
    </h1>
    <p style="font-weight: bold; font-size: 18px;">Halo, {{ $project->client->name }}!</p>
    <p>Kabar gembira! Brief project <strong>"{{ $project->title }}"</strong> telah kami tinjau dan kami sangat bersemangat untuk memulainya.</p>
    
    <div style="background-color: #bef264; border: 4px solid black; padding: 20px; margin: 20px 0; box-shadow: 8px 8px 0px black;">
        <p style="margin: 0; font-weight: 900; text-transform: uppercase;">Project Details:</p>
        <ul style="list-style: none; padding: 0; font-weight: bold;">
            <li>Budget: IDR {{ number_format($project->budget, 0, ',', '.') }}</li>
            <li>Est. Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</li>
        </ul>
    </div>

    <p>Tim **FREELANCE OS** akan segera mengirimkan kontrak kerja dan langkah selanjutnya via WhatsApp/Email ini.</p>
    
    <div style="margin-top: 40px; font-weight: 900; font-style: italic;">
        FREELANCE OS. <br>
        <span style="font-size: 12px; font-weight: normal;">Creative Agency & Digital Lab</span>
    </div>
</div>