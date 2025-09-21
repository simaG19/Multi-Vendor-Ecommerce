@props(['discountedProducts'])

<div class="bg-white rounded-lg shadow-sm p-6 mb-8">


    <div>
            <h2 class="text-2xl font-bold text-orange-600 mb-2">FLASH DEAL</h2>
        </br>
            {{-- <p class="text-gray-600">Hurry Up! The offer is limited. Grab while it lasts</p> --}}
        </div>
    <div class="flex items-center justify-between mb-6">


        <!-- Countdown Timer -->
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 text-white p-4 rounded-lg">
            <div class="flex items-center space-x-4" id="countdown">
                <div class="text-center">
                    <div class="text-2xl font-bold" id="days">00</div>
                    <div class="text-sm">Days</div>
                </div>
                <div class="text-2xl">:</div>
                <div class="text-center">
                    <div class="text-2xl font-bold" id="hours">00</div>
                    <div class="text-sm">Hours</div>
                </div>
                <div class="text-2xl">:</div>
                <div class="text-center">
                    <div class="text-2xl font-bold" id="minutes">00</div>
                    <div class="text-sm">Minutes</div>
                </div>
                <div class="text-2xl">:</div>
                <div class="text-center">
                    <div class="text-2xl font-bold" id="seconds">00</div>
                    <div class="text-sm">Seconds</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Deal Products -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($discountedProducts as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</div>

<script>
// Countdown Timer
function startCountdown() {
    // Set countdown to 24 hours from now
    const countdownDate = new Date().getTime() + (24 * 60 * 60 * 1000);

    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
        document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

        if (distance < 0) {
            clearInterval(timer);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
}

// Start countdown when page loads
document.addEventListener('DOMContentLoaded', startCountdown);
</script>
