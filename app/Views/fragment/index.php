<style>
.bigfigure{
    text-align: center;
    font-size:x-large;
    font-weight: bold;
}
</style>

<main>
    <h3>Welcome to Fragment</h3>
    <p>a painless IT inventory database</p>
    <p>version 1.0 (29/04/2025)</p>

    <div class="spacer"></div>

    <h3>Quick info</h3>
    <table class="table-qi" style="width:400px;table-layout:fixed;">
        <tr>
            <td></td>
            <td>Sibu</td>
            <td>Kapit</td>
            <td>Sarikei</td>
            <td>Tg. Manis</td>
        </tr>
        <tr>
            <td>total PC</td>
            <td class="bigfigure"><?= $dtsbu; ?></td>
            <td class="bigfigure"><?= $dtkpt; ?></td>
            <td class="bigfigure"><?= $dtsrk; ?></td>
            <td class="bigfigure"><?= $dttgm; ?></td>
        </tr>
        <tr>
            <td>total Laptop</td>
            <td class="bigfigure"><?= $ltsbu; ?></td>
            <td class="bigfigure"><?= $ltkpt; ?></td>
            <td class="bigfigure"><?= $ltsrk; ?></td>
            <td class="bigfigure"><?= $lttgm; ?></td>
        </tr>
        <tr>
            <td>total Printer</td>
            <td class="bigfigure"><?= $prsbu; ?></td>
            <td class="bigfigure"><?= $prkpt; ?></td>
            <td class="bigfigure"><?= $prsrk; ?></td>
            <td class="bigfigure"><?= $prtgm; ?></td>
        </tr>
    </table>

    <div class="spacer"></div>

    <h3>Quick links</h3>
    <p>
        <a href="/fragment/pc?office=sibu">Sibu Regional Office</a>
    </p>
    <p>
        <a href="/fragment/pc?office=kapit">Kapit Sub-Regional Office</a>
    </p>
    <p>
        <a href="/fragment/pc?office=sarikei">Sarikei Sub-Regional Office</a>
    </p>
    <p>
        <a href="/fragment/pc?office=tgmanis">Tg. Manis Office</a>
    </p>
</main>