<x-filament-panels::page>
    <div class="space-y-6">
        {{-- AI Summary --}}
        <x-filament::section>
            <x-slot name="heading">
                🤖 AI Analysis: Specialty Alignment with Market Needs
            </x-slot>
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-lg">
                    Analysis of <strong>10,800 student records</strong> and regional economic data reveals
                    significant misalignment between training programs and job market demands.
                    <strong class="text-danger-600">2 specialties</strong> require expansion,
                    <strong class="text-warning-600">1 requires reduction</strong>, and
                    <strong class="text-info-600">1 requires transformation</strong>.
                </p>
            </div>
        </x-filament::section>

        {{-- Recommendations --}}
        @foreach ($this->getRecommendations() as $rec)
            <x-filament::section>
                <div class="space-y-4">
                    {{-- Header --}}
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                @if ($rec['action'] === 'expand')
                                    <x-filament::badge color="success" size="lg">📈 EXPAND</x-filament::badge>
                                @elseif($rec['action'] === 'reduce')
                                    <x-filament::badge color="danger" size="lg">📉 REDUCE</x-filament::badge>
                                @else
                                    <x-filament::badge color="warning" size="lg">🔄 TRANSFORM</x-filament::badge>
                                @endif
                            </div>
                            <h3 class="text-2xl font-bold">{{ $rec['specialty'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $rec['reason'] }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Job Demand</div>
                            <x-filament::badge :color="str_contains($rec['job_demand'], 'High')
                                ? 'success'
                                : (str_contains($rec['job_demand'], 'Medium')
                                    ? 'warning'
                                    : 'danger')">
                                {{ $rec['job_demand'] }}
                            </x-filament::badge>
                        </div>
                    </div>

                    {{-- Metrics --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Current Students</div>
                            <div class="text-2xl font-bold">{{ number_format($rec['current_students']) }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Target Students</div>
                            <div class="text-2xl font-bold text-primary-600">
                                {{ number_format($rec['target_students']) }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Success Rate</div>
                            <div class="text-2xl font-bold">{{ $rec['success_rate'] }}%</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Timeline</div>
                            <div class="text-lg font-bold">{{ $rec['timeline'] }}</div>
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="border-t pt-4">
                        <div class="mb-2">
                            <strong>Institutes Affected:</strong>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach ($rec['institutes_affected'] as $inst)
                                    <x-filament::badge color="gray">{{ $inst }}</x-filament::badge>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <strong>Required Resources:</strong>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $rec['additional_resources'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>
