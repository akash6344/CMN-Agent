<?php

namespace App\Support;

class ChartHelper
{
    /**
     * Render SVG Bar Chart for Monthly Earnings
     */
    public static function renderBarChart(array $data, int $height = 140, string $barColor = '#f59e0b'): string
    {
        $count = count($data);
        if ($count === 0) return '';

        $maxVal = max(array_column($data, 'amount')) ?: 1;
        $width = 540;
        $barWidth = 48;
        $gap = ($width - ($count * $barWidth)) / ($count + 1);

        $svg = sprintf(
            '<svg class="chart-svg" viewBox="0 0 %d %d" preserveAspectRatio="none" style="width:100%%; height:%dpx; overflow:visible;">',
            $width,
            $height,
            $height
        );

        // Render Bars and Labels
        foreach ($data as $i => $item) {
            $x = $gap + ($i * ($barWidth + $gap));
            $ratio = $item['amount'] / ($maxVal * 1.15);
            $barH = max(12, round($ratio * ($height - 35)));
            $y = ($height - 30) - $barH;
            $isActive = !empty($item['active']);
            $fill = $isActive ? 'url(#barGradientActive)' : 'url(#barGradient)';

            $svg .= sprintf(
                '<g class="chart-bar-group" data-tooltip="%s: %s (%d deals)">
                    <rect x="%d" y="%d" width="%d" height="%d" rx="6" fill="%s" class="chart-bar %s"/>
                    <text x="%d" y="%d" text-anchor="middle" class="chart-label">%s</text>
                </g>',
                htmlspecialchars($item['month']),
                htmlspecialchars($item['label']),
                $item['deals'] ?? 0,
                $x,
                $y,
                $barWidth,
                $barH,
                $fill,
                $isActive ? 'is-active' : '',
                $x + ($barWidth / 2),
                $height - 10,
                htmlspecialchars($item['month'])
            );
        }

        // Add Gradients
        $svg .= '<defs>
            <linearGradient id="barGradient" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#f59e0b" stop-opacity="1" />
                <stop offset="100%" stop-color="#f97316" stop-opacity="0.85" />
            </linearGradient>
            <linearGradient id="barGradientActive" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#ea580c" />
                <stop offset="100%" stop-color="#c2410c" />
            </linearGradient>
        </defs>';

        $svg .= '</svg>';

        return $svg;
    }

    /**
     * Render SVG Donut Chart
     */
    public static function renderDonut(array $segments, int $size = 180, int $strokeWidth = 24): string
    {
        $radius = ($size - $strokeWidth) / 2;
        $circumference = 2 * M_PI * $radius;
        $cx = $size / 2;
        $cy = $size / 2;

        $total = array_sum(array_column($segments, 'value')) ?: 1;
        $offset = 0;

        $svg = sprintf('<svg width="%d" height="%d" viewBox="0 0 %d %d" class="donut-chart">', $size, $size, $size, $size);

        foreach ($segments as $seg) {
            $dash = ($seg['value'] / $total) * $circumference;
            $dashArray = sprintf('%.2f %.2f', $dash, $circumference - $dash);
            $dashOffset = sprintf('%.2f', -$offset);

            $svg .= sprintf(
                '<circle cx="%d" cy="%d" r="%.2f" fill="none" stroke="%s" stroke-width="%d" stroke-dasharray="%s" stroke-dashoffset="%s" class="donut-segment" transform="rotate(-90 %d %d)"></circle>',
                $cx,
                $cy,
                $radius,
                $seg['color'],
                $strokeWidth,
                $dashArray,
                $dashOffset,
                $cx,
                $cy
            );

            $offset += $dash;
        }

        $svg .= '</svg>';
        return $svg;
    }
}
