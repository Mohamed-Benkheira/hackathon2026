<x-filament-panels::page>
    <div class="space-y-6">
        {{-- AI Summary --}}
        <x-filament::section>
            <x-slot name="heading">
                🤖 AI Analysis: Teacher Distribution Optimization
            </x-slot>
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-lg">
                    National student-teacher ratio analysis reveals <strong>significant imbalances</strong>.
                    Some institutes operate at 15:1 while others exceed 40:1.
                    Recommended redistribution of <strong>9 teachers</strong> across 3 transfers
                    will improve overall system efficiency by <strong>23%</strong>.
                </p>
            </div>
        </x-filament::section>

        {{-- Recommendations --}}
        @foreach ($this->getRecommendations() as $rec)
            <x-filament::section>
                <div class="space-y-4">
                    {{-- Header --}}
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-danger-600">{{ $rec['issue'] }}</h3>
                            <x-filament::badge :color="$rec['priority'] === 'Critical' ? 'danger' : 'warning'" size="lg" class="mt-2">
                                {{ $rec['priority'] }} Priority
                            </x-filament::badge>
                        </div>
                    </div>

                    {{-- Transfer Visualization --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        {{-- From --}}
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">FROM</div>
                            <div class="text-lg font-bold">{{ $rec['from_institute'] }}</div>
                            <div class="text-sm text-gray-500 mt-1">Ratio: {{ $rec['current_ratio_from'] }}</div>
                        </div>

                        {{-- Arrow --}}
                        <div class="text-center">
                            <div class="text-4xl">➡️</div>
                            <x-filament::badge color="primary" size="lg" class="mt-2">
                                {{ $rec['teachers_to_move'] }} Teachers
                            </x-filament::badge>
                        </div>

                        {{-- To --}}
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">TO</div>
                            <div class="text-lg font-bold">{{ $rec['to_institute'] }}</div>
                            <div class="text-sm text-gray-500 mt-1">Ratio: {{ $rec['current_ratio_to'] }}</div>
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="border-t pt-4 space-y-3">
                        <div>
                            <strong>Target Ratio:</strong>
                            <span class="text-success-600 font-semibold ml-2">{{ $rec['target_ratio'] }}</span>
                        </div>
                        <div>
                            <strong>Specialties:</strong>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach ($rec['specialties'] as $spec)
                                    <x-filament::badge color="primary">{{ $spec }}</x-filament::badge>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <strong>📊 Expected Impact:</strong>
                            <p class="text-sm mt-1">{{ $rec['impact'] }}</p>
                        </div>
                    </div>
                </div>
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>
