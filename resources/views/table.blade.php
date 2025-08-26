@php
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;use PhpOffice\PhpSpreadsheet\Reader\Xlsx;$reader = new Xlsx();
    $reader->setReadEmptyCells(false);

    $file = public_path('Impetus 90-315 VSD.xlsx');
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();

    $highestRow = $worksheet->getHighestDataRow();
    $highestColumn = $worksheet->getHighestDataColumn();
    $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

    $mergedCells = $worksheet->getMergeCells();
    $mergedRanges = [];

    foreach ($mergedCells as $mergedCell) {
        $range = $mergedCell;
        $startCell = explode(':', $range)[0];
        $endCell = explode(':', $range)[1];

        $startCoordinate = Coordinate::coordinateFromString($startCell);
        $endCoordinate = Coordinate::coordinateFromString($endCell);

        $startCol = Coordinate::columnIndexFromString($startCoordinate[0]);
        $startRow = $startCoordinate[1];
        $endCol = Coordinate::columnIndexFromString($endCoordinate[0]);
        $endRow = $endCoordinate[1];

        $mergedRanges[] = [
            'startCol' => $startCol,
            'startRow' => $startRow,
            'endCol' => $endCol,
            'endRow' => $endRow,
            'colspan' => $endCol - $startCol + 1,
            'rowspan' => $endRow - $startRow + 1
        ];
    }

    $skipCells = [];

    foreach ($mergedRanges as $range) {
        for ($row = $range['startRow']; $row <= $range['endRow']; $row++) {
            for ($col = $range['startCol']; $col <= $range['endCol']; $col++) {
                if (!($row == $range['startRow'] && $col == $range['startCol'])) {
                    $skipCells[$row][$col] = true;
                }
            }
        }
    }
@endphp

<table>
    @for ($row = 1; $row <= $highestRow; $row++)
        <tr>
            @for ($col = 1; $col <= $highestColumnIndex; $col++)
                @if (!isset($skipCells[$row][$col]))
                    @php
                        $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row;
                        $cell = $worksheet->getCell($cellCoordinate);
                        $value = $cell->getValue();

                        if ($value !== null && substr($value, 0, 1) === '=') {
                            try {
                                $calculatedValue = $cell->getCalculatedValue();
                                if (is_numeric($calculatedValue)) {
                                    $value = number_format($calculatedValue, 2, '.', '');
                                } else {
                                    $value = $calculatedValue;
                                }
                            } catch (Exception $e) {
                                $value = $cell->getFormattedValue();
                            }
                        } else {
                            $value = $cell->getFormattedValue();
                        }

                        $colspan = 1;
                        $rowspan = 1;
                        $isMerged = false;

                        foreach ($mergedRanges as $range) {
                            if ($row == $range['startRow'] && $col == $range['startCol']) {
                                $colspan = $range['colspan'];
                                $rowspan = $range['rowspan'];
                                $isMerged = true;
                                break;
                            }
                        }

                        $isHeader = $row <= 3;

                        $cellClass = '';
                        if ($isMerged) {$cellClass .= 'merged-cell ';}
                        if ($isHeader) {$cellClass .= 'header-row ';}
                        if (is_numeric($value) && !$isHeader) {$cellClass .= 'numeric ';}
                    @endphp

                    @if ($isHeader)
                        <th colspan="{{ $colspan }}" rowspan="{{ $rowspan }}" class="{{ trim($cellClass) }}">
                            {{ $value }}
                        </th>
                    @else
                        <td colspan="{{ $colspan }}" rowspan="{{ $rowspan }}" class="{{ trim($cellClass) }}">
                            {{ $value }}
                        </td>
                    @endif
                @endif
            @endfor
        </tr>
    @endfor
</table>
