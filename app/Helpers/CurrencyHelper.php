<?php

if (! function_exists('formatRupiah')) {
    /**
     * Format number to Rupiah currency format.
     *
     * @param int|float $amount
     * @param bool $withPrefix
     * @return string
     */
    function formatRupiah($amount, bool $withPrefix = true): string
    {
        $formatted = number_format($amount, 0, ',', '.');

        return $withPrefix ? 'Rp ' . $formatted : $formatted;
    }
}

if (! function_exists('parseRupiah')) {
    /**
     * Parse Rupiah formatted string back to integer.
     *
     * @param string $amount
     * @return int
     */
    function parseRupiah(string $amount): int
    {
        // $cleaned = str_replace(['Rp', ' '], '', $amount);

        // Hapus 'Rp', spasi, dan titik
        $cleaned = str_replace(['Rp', ' ', '.'], '', $amount);

        return (int) $cleaned;
    }
}
