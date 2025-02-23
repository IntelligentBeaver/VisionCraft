<div class="container mx-auto px-4">
    <h4 class="mb-6 text-left font-semibold">Survey History</h4>

    @foreach ($surveyHistory as $survey)
        <div class="mt-6">
            <!-- Survey Title -->
            <h3 class="text-lg font-bold text-gray-800">
                Survey #{{ $survey->id }} - <span
                    class="text-gray-500">{{ $survey->created_at->format('d M Y, h:i A') }}</span>
            </h3>

            <!-- Recommendations Table -->
            <div class="mt-3 overflow-x-auto">
                <table class="w-full table-auto rounded-lg border border-gray-300 bg-white shadow-md">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-center">Job Title</th>
                            <th class="px-4 py-2 text-center">Industry</th>
                            <th class="px-4 py-2 text-center">Functional Area</th>
                            <th class="px-4 py-2 text-center">Role</th>
                            <th class="px-4 py-2 text-center">Similarity Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($survey->recommendations as $recommendation)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $recommendation->job_title }}</td>
                                <td class="px-4 py-2">{{ $recommendation->industry }}</td>
                                <td class="px-4 py-2">{{ $recommendation->functional_area }}</td>
                                <td class="px-4 py-2">{{ $recommendation->role }}</td>
                                <td class="px-4 py-2">
                                    <span class="badge badge-primary px-3 py-1">
                                        {{ number_format($recommendation->similarity_score * 100, 2) }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
