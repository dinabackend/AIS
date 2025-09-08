@php
    // Extract filename from file path
    $filename = basename($file);
    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $reader->setReadEmptyCells(false);

    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();

    $highestRow = $worksheet->getHighestDataRow();
    $highestColumn = $worksheet->getHighestDataColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    // Get all merged cell ranges
    $mergedCells = $worksheet->getMergeCells();
    $mergedRanges = [];

    foreach ($mergedCells as $mergedCell) {
        $range = $mergedCell;
        $startCell = explode(':', $range)[0];
        $endCell = explode(':', $range)[1];

        $startCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::coordinateFromString($startCell);
        $endCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::coordinateFromString($endCell);

        $startCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($startCoordinate[0]);
        $startRow = $startCoordinate[1];
        $endCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($endCoordinate[0]);
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

    // Keep track of cells that should be skipped (part of merged cells)
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

<!DOCTYPE html>
<html>
<head>
    <title>{{ $filenameWithoutExtension }} - Excel Table</title>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
            font-family: "Inter", sans-serif;
        }

        th,
        td {
            border: 1px solid #dbdbdb;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #263c66; /* Indigo background */
            color: white; /* White text */
            font-weight: bold;
        }

        .header-row {
            background-color: #263c66 !important; /* Indigo background */
            color: white !important; /* White text */
            font-weight: 500;
            font-size: 16px;
            line-height: 100%;
            text-align: center;
            vertical-align: middle;
        }

        .merged-cell {
            background-color: #fff;
            text-align: center;
            vertical-align: middle;
        }

        .merged-cell.header-row {
            background-color: #263c66 !important; /* Indigo for merged header cells */
            color: white !important;
            font-weight: 500;
            font-size: 16px;
            line-height: 100%;
            text-align: center;
            vertical-align: middle;
        }

        .numeric {
            background-color: #fff;
            text-align: center;
            padding: 20px;
        }

        .center {
            text-align: center;
        }
        .cell-bg {
            padding: 5px 12px;
            border-radius: 5px;
            background: #d1d1d1;
        }
    </style>
</head>
<body>
    <table>
        @for ($row = 1; $row <= $highestRow; $row++)
            <tr>
                @for ($col = 1; $col <= $highestColumnIndex; $col++)
                    @if (!isset($skipCells[$row][$col]))
                        @php
                            $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
                            $cell = $worksheet->getCell($cellCoordinate);
                            $value = $cell->getValue();

                            // Handle formulas and calculate values
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

                            // Check if this cell is part of a merged range
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

                            // Determine if this is a header row (first 4 rows contain headers)
                            $isHeader = $row <= $headerRows;

                            // Determine cell class based on content
                            $cellClass = '';
                            if ($isMerged) {
                                $cellClass .= 'merged-cell ';
                            }
                            if ($isHeader) {
                                $cellClass .= 'header-row ';
                            }
                            if (is_numeric($value) && !$isHeader) {
                                $cellClass .= 'numeric ';
                            }
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

    {{--<script>
        document.addEventListener('DOMContentLoaded', function() {

            const mergedCells = document.querySelectorAll('.merged-cell:not(.header-row)');
            mergedCells.forEach(cell => {
                cell.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#e6f3ff';
                });
                cell.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '#f9f9f9';
                });
            });
        });
    </script>--}}
</body>
</html>
