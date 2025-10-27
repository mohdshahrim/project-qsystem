<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qsystem | RDS Print</title>
    <style>
        /* basic style */
        table {
            width: 100%;
            border: 1px gray solid;
            border-collapse: collapse;
        }
        table tr th:first-child {
            text-align: center;
        }
        table tr th {
            border: 1px gray solid;
            padding: 2px;
        }
        table tr td:first-child {
            text-align: center;
        }
        table tr td {
            border: 1px gray solid;
            padding: 2px;
        }

        @media print {
            /* hidden during print */
            .print-hidden {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-hidden">
        <p>Press Ctrl + P to print</p>
    </div>

    <header>
        <h1><?= $title ?></h1>
    </header>
    <main>
        <?php if ($list == 1): ?>
            <table>
                <tr>
                    <th>No.</th>
                    <th>License No</th>
                    <th>Licensee</th>
                    <th>Email</th>
                    <th>Contact Person</th>
                </tr>
                <?php foreach ($licensees as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['license_no'] ?></td>
                        <td><?= $row['licensee_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['contact_person'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php elseif ($list == 2): ?>    
            <table>
                <tr>
                    <th>No.</th>
                    <th>Mill No</th>
                    <th>Processor Name</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($mills as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['mill_no'] ?></td>
                        <td><?= $row['mill_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['contact_person'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php elseif ($list == 3): ?>
            <table>
                <tr>
                    <th>No.</th>
                    <th>License No</th>
                    <th>Licensee</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($lr as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['license_no'] ?></td>
                        <td><?= $row['licensee_name'] ?></td>
                        <td>
                            <?php
                                $d = new \DateTime((string)$row['delivery_date']);
                                echo $d->format("d-m-Y");
                            ?>
                        </td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php elseif ($list == 4): ?>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Mill No</th>
                    <th>Processor Name</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($mr as $key=>$row):?>
                    <tr>
                        <td><?= ($key+1) ?></td>
                        <td><?= $row['mill_no'] ?></td>
                        <td><?= $row['mill_name'] ?></td>
                        <td>
                            <?php
                                $d = new \DateTime((string)$row['delivery_date']);
                                echo $d->format("d-m-Y");
                            ?>
                        </td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php endif ?>
    </main>

    <footer>

    </footer>
</body>
</html>