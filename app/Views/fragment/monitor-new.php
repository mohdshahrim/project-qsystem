<div class="w3-container"
x-data="{
    step1: true,
    step2: false,
    step3: false,
    site_id: 1,
    site_name: 'DEFAULT',
    host: [],
    monitor:{
        site: '',
        asset_no: '',
        serial_no: '',
        model: '',
        screen_size: '',
        notes: '',
        host: '',
    },
    loadHostList({host}) {
        minAjax({
            url: '/fragment/pc/api/get-by-site/' + this.site_id,
            type: 'GET',
            success: (response) => {
                data = JSON.parse(response);
                this.host = data.pc;
            }
        });
    },
    submitMonitor() {
        console.log('submitting...');
        minAjax({
            url: '/fragment/monitor/api/create',
            type: 'POST',
            data: {
                site: this.monitor.site,
                asset_no: this.monitor.asset_no,
                serial_no: this.monitor.serial_no,
                model: this.monitor.model,
                screen_size: this.monitor.screen_size,
                notes: this.monitor.notes,
                host: this.monitor.host,
            },
            success: (response) => {
                data = JSON.parse(response);
                if (data['title']=='OK') {
                    console.log('OK');
                    window.location.href = '/fragment/monitor';
                } else {
                    console.log('Failed');
                }
            },
        });
    }
    }">
    <h1>Add Monitor</h1>

    <br>

    <!-- STEP 1 -->
    <div x-show="step1">
        <h3>Step 1 of 3 <b>Choose Site</b></h3>

        <br>

        <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 250px); column-gap: 20px;">
            <?php foreach($sites as $key=>$row): ?>
                <a class="w3-border w3-white w3-padding w3-round text-decoration-none w3-hover-asphalt" x-on:click="site_id=<?= $row['id'] ?>;site_name='<?= $row['site_id'] ?>';step1=false;step2=true;step3=false;" style="cursor:pointer;">
                    <h3><?= $row['site_id'] ?></h3>
                    <p><?= $row['site_name'] ?></p>
                </a>
            <?php endforeach ?>
        </div>
    </div>

    <!-- STEP 2 -->
    <div x-show="step2">
        <h3>Step 2 of 3 <b>Fill in information</b></h3>

        <div>
            <button x-on:click="step1=true; step2=false; step3=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step1=false; step2=false; step3=true; loadHostList($data);" class="w3-button w3-asphalt w3-round">Next</button>
        </div>

        <br>

        <table>
            <colgroup>
                <col>
                <col width="350px">
            </colgroup>

            <!-- SITE -->
            <tr>
                <td>
                    <label class="w3-label">Site</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <p x-text="site_name"></p>
                </td>
            </tr>

            <!-- ASSET NO -->
            <tr>
                <td>
                    <label class="w3-label">Asset No</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="monitor.asset_no" type="text" name="asset_no" class="w3-input w3-border"></input>
                    <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                </td>
            </tr>

            <!-- SERIAL NO -->
            <tr>
                <td>
                    <label class="w3-label">Serial No</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="monitor.serial_no" type="text" name="serial_no" class="w3-input w3-border"></input>
                </td>
            </tr>

            <!-- MODEL -->
            <tr>
                <td>
                    <label class="w3-label">Model</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="monitor.model" type="text" name="model" class="w3-input w3-border"></input>
                </td>
            </tr>
            
            <!-- SCREEN SIZE -->
            <tr>
                <td>
                    <label class="w3-label">Screen Size</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="monitor.screen_size" type="text" name="screen_size" class="w3-input w3-border"></input>
                </td>
            </tr>
            
            <!-- NOTES -->
            <tr>
                <td>
                    <label class="w3-label">Notes</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="monitor.notes" type="text" name="notes" class="w3-input w3-border"></input>
                </td>
            </tr>
        </table>
    </div>

    <!-- STEP 3 -->
    <div x-show="step3">
        <h3>Step 3 of 3 <b>Assign Host (optional)</b></h3>

        <div>
            <button x-on:click="step2=true; step3=false; step1=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="submitMonitor()" class="w3-button w3-asphalt w3-round">Save</button>
        </div>

        <br>

        <h3>Select host PC of monitor <u><span x-text="monitor.asset_no"></span></u></h3>

        <br>

        <div>
            <table>
                <tr>
                    <td>
                        <input type="radio" name="hostname" id="default" value="1"></input>
                        <label for="default">NO HOST</label>
                    </td>
                </tr>
                <template x-for="(item, index) in host" :key="item.id">
                    <tr>
                        <td x-id="['hostname']">
                            <input type="radio" name="hostname" :id="$id('hostname')" :value="item.id" x-on:click="monitor.host=item.id"></input>
                            <label x-text="item.hostname + ' (' + item.ip_address + ')'" :for="$id('hostname')"></label>
                        </td>
                    </tr>
                </template>
            </table>
        </div>
    </div>
</div>

<script>
    function hello() {
        console.log("tehee");
    }
</script>