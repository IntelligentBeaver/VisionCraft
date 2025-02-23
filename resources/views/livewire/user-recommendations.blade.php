<div class="container px-4 mx-auto">
    <h4 class="mb-6 font-semibold text-left">Job Recommendations</h4>

    <div class="grid grid-cols-1 gap-6 pb-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($recommendations as $recommendation)
            <div
                class="flex flex-col p-5 text-left align-middle transition duration-300 border rounded-lg hover:border-primary hover:shadow-md">
                <div class="flex-grow">
                    <h4 class="font-extrabold text-primary">{{ $recommendation->job_title }}</h4>

                    <p class="mt-3 text-gray-700">
                        <span class="font-semibold">Industry:</span> {{ $recommendation->industry }}
                    </p>

                    <p class="text-gray-700">
                        <span class="font-semibold">Functional Area:</span> {{ $recommendation->functional_area }}
                    </p>

                    <p class="text-gray-700">
                        <span class="font-semibold">Role:</span> {{ $recommendation->role }}
                    </p>
                </div>

                <div class="mt-3">
                    <span class="px-3 py-3 font-medium badge badge-primary w-fit text-primary-content">
                        Similarity Score: {{ number_format($recommendation->similarity_score * 100, 2) }}%
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
