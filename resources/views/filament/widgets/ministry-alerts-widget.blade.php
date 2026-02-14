<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            🤖 AI Insights & Alerts
        </x-slot>

        <div class="space-y-3">
            @foreach ($this->getAlerts() as $alert)
                @php
                    $bgColors = [
                        'danger' => 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800',
                        'warning' => 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800',
                        'info' => 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800',
                    ];
                    $textColors = [
                        'danger' => 'text-red-700 dark:text-red-400',
                        'warning' => 'text-yellow-700 dark:text-yellow-400',
                        'info' => 'text-blue-700 dark:text-blue-400',
                    ];
                @endphp
                <div class="flex items-start gap-3 p-4 border rounded-lg {{ $bgColors[$alert['type']] }}">
                    <span class="text-2xl">{{ $alert['icon'] }}</span>
                    <div class="flex-1">
                        <h4 class="font-semibold {{ $textColors[$alert['type']] }}">
                            {{ $alert['title'] }}
                        </h4>
                        <p class="text-sm mt-1 text-gray-600 dark:text-gray-400">
                            {{ $alert['message'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
