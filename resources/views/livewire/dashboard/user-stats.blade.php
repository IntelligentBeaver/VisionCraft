<div>
    <div class="card my-2 bg-base-100 outline outline-[0.2px] outline-primary">
        <div class="card-body text-center">
            <h2 class="card-title text-center font-bold">Total Users</h2>
            <h2 class="font-extrabold text-primary">{{ $totalUsers }}</h2>
        </div>
    </div>
    <!-- Total Admins Card -->
    <div class="flex flex-col items-stretch justify-between sm:flex-row sm:gap-4">
        <div class="card my-2 flex-1 bg-base-100 outline outline-[0.2px] outline-primary">
            <div class="card-body text-center">
                <h2 class="card-title text-lg font-bold">Total Admins</h2>
                <p class="text-4xl font-extrabold text-secondary">{{ $totalAdmins }}</p>
            </div>
        </div>
        <!-- Total Regular Users Card -->
        <div class="card my-2 flex-1 bg-base-100 outline outline-[0.2px] outline-primary">
            <div class="card-body text-center">
                <h2 class="card-title text-lg font-bold">Total Regular Users</h2>
                <p class="text-4xl font-extrabold text-accent">{{ $totalRegularUsers }}</p>
            </div>
        </div>
    </div>
</div>
