<x-filament-panels::page>
    <div class="space-y-6">
        {{-- AI Summary Card --}}
        <x-filament::section>
            <x-slot name="heading">
                🤖 AI Analysis Summary
            </x-slot>
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-lg">
                    Based on population density, economic activity, and current institute coverage,
                    <strong class="text-primary-600">4 regions</strong> require immediate attention for new
                    vocational training centers. Total projected enrollment: <strong>3,400 students</strong>.
                </p>
                <div class="grid grid-cols-3 gap-4 mt-4 not-prose">
                    <x-filament::section>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-danger-600">2</div>
                            <div class="text-sm text-gray-600">High Priority</div>
                        </div>
                    </x-filament::section>
                    <x-filament::section>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-warning-600">2</div>
                            <div class="text-sm text-gray-600">Medium Priority</div>
                        </div>
                    </x-filament::section>
                    <x-filament::section>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-success-600">460M</div>
                            <div class="text-sm text-gray-600">Total Investment (DZD)</div>
                        </div>
                    </x-filament::section>
                </div>
            </div>
        </x-filament::section>

        {{-- Recommendations --}}
        @foreach ($this->getRecommendations() as $rec)
            <x-filament::section>
                <div class="space-y-4">
                    {{-- Header --}}
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold">{{ $rec['wilaya'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $rec['reason'] }}</p>
                        </div>
                        <div class="text-right">
                            <x-filament::badge :color="$rec['priority'] === 'High' ? 'danger' : 'warning'" size="lg">
                                {{ $rec['priority'] }} Priority
                            </x-filament::badge>
                            <div class="text-sm text-gray-500 mt-2">
                                Impact Score: <strong>{{ $rec['impact_score'] }}/100</strong>
                            </div>
                        </div>
                    </div>

                    {{-- Details Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <h4 class="font-semibold mb-2">📊 Economic Profile</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $rec['economic_focus'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">🎓 Recommended Specialties</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($rec['recommended_specialties'] as $spec)
                                    <x-filament::badge color="primary">{{ $spec }}</x-filament::badge>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">📈 Projected Enrollment</h4>
                            <p class="text-2xl font-bold text-primary-600">
                                {{ number_format($rec['estimated_students']) }} students</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">💰 Investment Required</h4>
                            <p class="text-2xl font-bold text-success-600">{{ $rec['investment_needed'] }}</p>
                            <p class="text-xs text-gray-500">Timeline: {{ $rec['timeline'] }}</p>
                        </div>
                    </div>
                </div>
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>
