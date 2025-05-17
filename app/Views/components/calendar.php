<style>
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .calendar-header a {
        text-decoration: none;
        color: #111;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: background 0.2s;
    }

    .calendar-header a:hover {
        background: #f4f4f4;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background: #eee;
    }

    .day {
        aspect-ratio: 1/1;
        position: relative;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        font-weight: 500;
    }

    .day.has-dream {
        color: #fff;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .day.has-dream::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .day-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 0.5rem;
        font-size: 0.9rem;
    }

    .day-number {
        font-weight: bold;
        margin-bottom: 0.3rem;
    }
</style>

<?php
    $currentDate = strtotime("$year-$month-01");
    $prevMonth = strtotime('-1 month', $currentDate);
    $nextMonth = strtotime('+1 month', $currentDate);
?>

<div class="calendar-header">
    <a href="/calendar/<?= date('Y/m', $prevMonth) ?>">&larr; <?= date('F Y', $prevMonth) ?></a>
    <div><?= date('F Y', $currentDate) ?></div>
    <a href="/calendar/<?= date('Y/m', $nextMonth) ?>"><?= date('F Y', $nextMonth) ?> &rarr;</a>
</div>

<div class="calendar">
    <?php
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for ($day = 1; $day <= $daysInMonth; $day++):
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
        $dream = $dreamsByDate[$date] ?? null;
        $image = $dream['image'] ?? null;
        ?>
        <div class="day <?= $dream ? 'has-dream' : '' ?>" <?= $dream ? "style=\"background-image: url('{$image}')\"" : '' ?>>
        
            <div class="day-content">
                <div class="day-number"><?= $day ?></div>
                <?php if ($dream): ?>
                    <div class="dream-title"><?= $dream['title'] ?></div>
                    
                <?php endif; ?>
                
            </div>
                </div>
            
    <?php endfor; ?>
</div>
