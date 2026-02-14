<x-filament-panels::page>
    <div class="space-y-6">
        {{-- AI Summary --}}
        <x-filament::section>
            <x-slot name="heading">
                🤖 AI Analysis: Capacity Optimization Across Network
            </x-slot>
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-lg">
                    Infrastructure audit reveals <strong>inefficient capacity distribution</strong>.
                    While some institutes operate <strong class="text-danger-600">above 100% capacity</strong>,
                    others remain <strong class="text-warning-600">below 70%</strong>.
                    Optimal range: <strong>75-90% utilization</strong>.
                </p>
            </div>
        </x-filament::section>

        {{-- Utilization Chart Summary --}}
        <div class="grid grid-cols-4 gap-4">
            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-danger-600">1</div>
                    <div class="text-sm text-gray-600">Overcapacity</div>
                </div>
            </x-filament::section>
            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-warning-600">1</div>
                    <div class="text-sm text-gray-600">Near Capacity</div>
                </div>
            </x-filament::section>
            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-success-600">1</div>
                    <div class="text-sm text-gray-600">Optimal</div>
                </div>
            </x-filament::section>
            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-info-600">1</div>
                    <div class="text-sm text-gray-600">Underutilized</div>
                </div>
            </x-filament::section>
        </div>

        {{-- Recommendations --}}
        @foreach ($this->getRecommendations() as $rec)
            <x-filament::section>
                <div class="space-y-4">
                    {{-- Header --}}
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold">{{ $rec['institute'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $rec['issue'] }}</p>
                        </div>
                        <div class="text-right">
                            @php
                                $statusColors = [
                                    'overcapacity' => 'danger',
                                    'near_capacity' => 'warning',
                                    'optimal' => 'success',
                                    'underutilized' => 'info',
                                ];
                            @endphp
                            <x-filament::badge :color="$statusColors[$rec['status']]" size="lg">
                                {{ $rec['utilization'] }}% Utilization
                            </x-filament::badge>
                            <div class="text-sm text-gray-500 mt-2">
                                Priority: <strong>{{ $rec['priority'] }}</strong>
                            </div>
                        </div>
                    </div>

                    {{-- Metrics --}}
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="text-sm text-gray-500">Capacity</div>
                            <div class="text-2xl font-bold">{{ number_format($rec['capacity']) }}</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="text-sm text-gray-500">Current Students</div>
                            <div class="text-2xl font-bold text-primary-600">
                                {{ number_format($rec['current_students']) }}</div>
                        </div>
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="text-sm text-gray-500">Available Rooms</div>
                            <div class="text-2xl font-bold">{{ $rec['rooms_available'] }}</div>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Utilization</span>
                            <span class="font-bold">{{ $rec['utilization'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                            @php
                                $barColor =
                                    $rec['utilization'] > 95
                                        ? 'bg-danger-600'
                                        : ($rec['utilization'] > 85
                                            ? 'bg-warning-600'
                                            : ($rec['utilization'] < 70
                                                ? 'bg-info-600'
                                                : 'bg-success-600'));
                            @endphp
                            <div class="{{ $barColor }} h-4 rounded-full transition-all duration-300"
                                style="width: {{ min($rec['utilization'], 100) }}%"></div>
                        </div>
                    </div>

                    {{-- Recommendation --}}
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border-l-4 border-blue-500">
                        <strong>💡 Recommended Action:</strong>
                        <p class="mt-1">{{ $rec['recommendation'] }}</p>
                    </div>
                </div>
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>
