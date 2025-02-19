<x-filament-panels::page class="fi-dashboard-page">
    @if (method_exists($this, 'filtersForm'))
        {{ $this->filtersForm }}
    @endif
        <x-filament-widgets::widgets
            :columns="1"
            :data="
            [
                ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
            ]
        "
            :widgets="$this->headerWidgets()"
        />
    <x-filament-widgets::widgets
        :columns="$this->getColumns()"
        :data="
            [
                ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
            ]
        "
        :widgets="$this->footerWidgets()"
    />
</x-filament-panels::page>

