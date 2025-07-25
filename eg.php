<?php
// Target date (change as needed)
$targetDate = "2025-08-15";

// Convert to DateTime objects
$today = new DateTime();
$target = new DateTime($targetDate);

// Compare dates
$interval = $today->diff($target);
$days = $interval->days;

echo $interval->format("%y%m%d") ."";

if ($today > $target) {
    echo "⏳ $days days have **passed** since $targetDate.";
} elseif ($today < $target) {
    echo "📅 $days days are **left** until $targetDate.";
} else {
    echo "🎉 Today is the day: $targetDate!";
}
?>
