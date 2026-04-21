<div class="w3-container"
x-data="{
    reload_monitor: false,
    sites: [],
    monitors: [],
    async loadSites({sites}){
        const response = await fetch('/fragment/site/api/get-sites');

        if (!response.ok) {
            console.log('error ${response.status}');
        } else {
            const data = await response.json();
            this.sites = data.sites;
            console.log(data.sites);
        }
    },
}"

x-init="loadSites({$data})">
    <h1>List of Monitors</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/monitor/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <span>
            <template x-for="(item, index) in sites">
                <div class="w3-margin-right" style="display: inline-block;" x-id="['site']">
                    <input class="w3-check" type="checkbox" :id="$id('site')" :value="item.id">
                    <label x-text="item.site_id" :for="$id('site')" :title="item.site_name"></label>
                </div>
            </template>
        </span>

        &nbsp;
        &nbsp;
        &nbsp;

        <div class="w3-margin-left" style="display: inline-block;">
            <input class="w3-check w3-margin-left" type="checkbox" id="include-unhosted">
            <label for="include-unhosted">include unhosted</label>
        </div>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered">
        <tr>
            <td>no</td>
            <td>asset no</td>
            <td>serial no</td>
            <td>model</td>
            <td>screen size</td>
            <td>host</td>
            <td>site</td>
            <td>notes</td>
            <td>created at</td>
            <td>updated at</td>
        </tr>
        <?php foreach ($monitor as $key=>$row): ?>
            <tr>
                <td><?= ($key+1) ?></td>
                <td><?= $row['asset_no'] ?></td>
                <td><?= $row['serial_no'] ?></td>
                <td><?= $row['model'] ?></td>
                <td><?= $row['screen_size'] ?></td>
                <td><?= $row['hostname'] ?></td>
                <td><?= $row['site_id'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td class="w3-small"><?= $row['created_at'] ?></td>
                <td class="w3-small"><?= $row['updated_at'] ?></td>
                <td class="w3-center">
                    <a href="/fragment/monitor/<?= $row['id'] ?>">view</a>
                    &nbsp;
                    <a href="/fragment/monitor/edit/<?= $row['id'] ?>">edit</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>