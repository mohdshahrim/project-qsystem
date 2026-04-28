<div class="w3-container"
x-data="{
    step1: true, // choose site
    step2: false, // fill in detail
    step3: false, // select monitor
    step4: false, // select user
    disableStep2next: true,
    site_id: 1,
    site_name: 'DEFAULT',
    users: [],
    monitors: [],
    pc: {
        hostname: '',
        asset_no: '',
        serial_no: '',
        model: '',
        os: '',
        ip_address: '',
        computer_type: '',
        assigned_user: '',
        site: '',
        physical_location: '',
        notes: '',
    },
    loadMonitorList({monitors}) {
        minAjax({
            url: `/fragment/monitor/api/get-by-site/${this.site_id}`,
            type: 'GET',
            data: {
                only_unhosted: 'true',
            },
            success: (response) => {
                data = JSON.parse(response);
                this.monitors = data.monitor;
            }
        });
    },
    loadUserList({users}) {
        minAjax({
            url: '/fragment/user/api/get-by-site/' + this.site_id,
            type: 'GET',
            success: (response) => {
                data = JSON.parse(response);
                this.users = data.user;
            }
        });
    },
    }">
    <h1>Add PC</h1>

    <br>

    <!-- STEP 1 -->
    <div x-show="step1">
        <h3>Step 1 of 4 <b>Choose Site</b></h3>

        <div>
            <a href="/fragment/pc" class="w3-button w3-border w3-border-asphalt w3-round">cancel</a>
        </div>

        <br>

        <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 250px); column-gap: 20px;">
            <?php foreach($sites as $key=>$row): ?>
                <a class="w3-border w3-white w3-padding w3-round text-decoration-none w3-hover-asphalt" x-on:click="pc.site=<?= $row['id'] ?>;site_id=<?= $row['id'] ?>;site_name='<?= $row['site_id'] ?>';step1=false;step2=true;step3=false;step4=false;" style="cursor:pointer;">
                    <h3><?= $row['site_id'] ?></h3>
                    <p><?= $row['site_name'] ?></p>
                </a>
            <?php endforeach ?>
        </div>
    </div>

    <!-- STEP 2 -->
    <div x-show="step2">
        <h3>Step 2 of 4 <b>Fill in information</b></h3>

        <div>
            <button x-on:click="step1=true; step2=false; step3=false; step4=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step1=false; step2=false; step3=true; step4=false; loadMonitorList($data);" class="w3-button w3-asphalt w3-round" x-bind:disabled="disableStep2next">Next</button>
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

            <!-- HOSTNAME -->
            <tr>
                <td>
                    <label class="w3-label">Hostname</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.hostname" type="text" name="hostname" class="w3-input w3-border" x-effect="if (pc.hostname!='' && pc.asset_no!=''){disableStep2next=false;}else{disableStep2next=true;}" ></input>
                    <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                </td>
            </tr>

            <!-- ASSET NO -->
            <tr>
                <td>
                    <label class="w3-label">Asset No</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.asset_no" type="text" name="asset_no" class="w3-input w3-border" x-effect="if (pc.hostname!='' && pc.asset_no!=''){disableStep2next=false;}else{disableStep2next=true;}" ></input>
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
                    <input x-model="pc.serial_no" type="text" name="serial_no" class="w3-input w3-border"></input>
                </td>
            </tr>

            <!-- MODEL -->
            <tr>
                <td>
                    <label class="w3-label">Model</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.model" type="text" name="model" class="w3-input w3-border"></input>
                </td>
            </tr>

            <!-- OS -->
            <tr>
                <td>
                    <label class="w3-label">OS</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.os" type="text" name="os" class="w3-input w3-border"></input>
                </td>
            </tr>

            <!-- IP ADDRESS -->
            <tr>
                <td>
                    <label class="w3-label">IP address</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.ip_address" type="text" name="ip_address" class="w3-input w3-border"></input>
                </td>
            </tr>
            
            <!-- COMPUTER TYPE -->
            <tr>
                <td>
                    <label class="w3-label">Computer type</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.computer_type" type="text" name="computer_type" class="w3-input w3-border"></input>
                </td>
            </tr>
            
            <!-- NOTES -->
            <tr>
                <td>
                    <label class="w3-label">Notes</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="pc.notes" type="text" name="notes" class="w3-input w3-border"></input>
                </td>
            </tr>
        </table>
    </div>

    <!-- STEP 3 -->
    <div x-show="step3">
        <h3>Step 3 of 4 <b>Assign Monitor</b></h3>

        <div>
            <button x-on:click="step2=true; step3=false; step1=false; step4=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="submitMonitor()" class="w3-button w3-asphalt w3-round">Save</button>
        </div>

        <div>
            <p class="w3-small w3-text-grey">Only unhosted monitors from <span x-text="site_name"></span> are shown here. You may skip if you want to.</p>
        </div>

        <br>

        <table>
            <colgroup>
                <col width="200px">
                <col width="200px">
            </colgroup>
            <tr>
                <td>asset no</td>
                <td>serial no</td>
            </tr>
            <template x-for="(item, index) in monitors">
                <tr class="w3-white w3-border w3-hover-asphalt" x-on:click="pc.monitor=item.id;step1=false;step2=false;step3=false;step4=true;" style="cursor:pointer;">
                    <td class="w3-padding" x-text="item.asset_no"></td>
                    <td class="w3-padding" x-text="item.serial_no"></td>
                </tr>
            </template>
        </table>
    </div>

    <!-- STEP 4 -->
    <div x-show="step4">
        <h3>Step 4 of 4 <b>Assign User</b></h3>
    </div>
</div>