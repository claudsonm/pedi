<?php

namespace Claudsonm\Pedi\Tests\Support;

trait PagSeguroTestHelpers
{
    /**
     * @return array[]
     */
    protected function provideFileDetails(
        array $files,
        array $differentItems = [],
        int $defaultTotal = 3,
        int $defaultDetails = 1
    ): array {
        return array_map(function ($file) use ($differentItems, $defaultTotal, $defaultDetails) {
            $total = $defaultTotal;
            $details = $defaultDetails;
            foreach ($differentItems as $fileName => $info) {
                $endsWith = substr($file, strlen($file) - strlen($fileName));
                if ($endsWith === $fileName) {
                    $total = $info['total'];
                    $details = $info['details'];
                }
            }

            return [
                $file,
                $total,
                $details,
            ];
        }, $files);
    }
}
