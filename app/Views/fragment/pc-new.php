<div class="w3-container"
x-data="{
    step1: true, // choose site
    step2: false, // fill in detail
    step3: false, // select monitor
    step4: false, // select user
    step5: false, // confirmation
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
        monitor: '',
    },
    monitor: {},
    user: {},
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
            url: `/fragment/staff/api/get-by-site/${this.site_id}`,
            type: 'GET',
            success: (response) => {
                data = JSON.parse(response);
                this.users = data.staff; // on the controller, staff = user
            }
        });
    },
    submit() {
        minAjax({
            url: '/fragment/pc/api/create',
            type: 'POST',
            data: {
                hostname: this.pc.hostname,
                asset_no: this.pc.asset_no,
                serial_no: this.pc.serial_no,
                model: this.pc.model,
                os: this.pc.os,
                ip_address: this.pc.ip_address,
                computer_type: this.pc.computer_type,
                assigned_user: this.pc.assigned_user,
                site: this.pc.site,
                physical_location: this.pc.physical_location,
                notes: this.pc.notes,
                monitor_id: this.pc.monitor,
            },
            success: (response) => {
                data = JSON.parse(response);
                if (data['title']=='OK') {
                    console.log('OK');
                    window.location.href = '/fragment/pc';
                } else {
                    console.log('Failed');
                }
            },
        });
    }
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
                <a class="w3-border w3-white w3-padding w3-round text-decoration-none w3-hover-asphalt" x-on:click="pc.site=<?= $row['id'] ?>;site_id=<?= $row['id'] ?>;site_name='<?= $row['site_id'] ?>';step1=false;step2=true;step3=false;step4=false;step5=false;" style="cursor:pointer;">
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
            <button x-on:click="step1=true; step2=false; step3=false; step4=false; step5=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step1=false; step2=false; step3=true; step4=false; step5=false; loadMonitorList($data);" class="w3-button w3-asphalt w3-round" x-bind:disabled="disableStep2next">Next</button>
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
                    <select x-model="pc.computer_type" name="computer_type" class="w3-input w3-border">
                        <?php foreach($computer_types as $key => $value): ?>
                            <option value="<?= $value ?>"><?= $value ?></option>
                        <?php endforeach ?> 
                    </select>
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
            <button x-on:click="step2=true; step3=false; step1=false; step4=false; step5=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step4=true; step3=false; step2=false; step1=false; step5=false; loadUserList($data);" class="w3-button w3-asphalt w3-round">Skip</button>
        </div>

        <br>

        <p>only unhosted monitors from <span x-text="site_name"></span> are shown here</p>

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
                <tr class="w3-white w3-border w3-hover-asphalt" x-on:click="pc.monitor=item.id; monitor.asset_no=item.asset_no; step1=false; step2=false; step3=false; step4=true; step5=false; loadUserList($data);" style="cursor:pointer;">
                    <td class="w3-padding" x-text="item.asset_no"></td>
                    <td class="w3-padding" x-text="item.serial_no"></td>
                </tr>
            </template>
        </table>
    </div>

    <!-- STEP 4 -->
    <div x-show="step4">
        <h3>Step 4 of 4 <b>Assign User</b> (optional)</h3>

        <div>
            <button x-on:click="step3=true; step4=false; step5=false; step1=false; step2=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step5=true; step4=false; step3=false; step2=false; step1=false;" class="w3-button w3-asphalt w3-round">Skip</button>
        </div>

        <br>

        <p>only users from <span x-text="site_name"></span> are shown here</p>

        <br>

        <table>
            <colgroup>
                <col width="80px">
                <col width="350px">
                <col width="250px">
                <col width="250px">
            </colgroup>
            <tr>
                <td class="w3-small">staff ID</td>
                <td class="w3-small">fullname</td>
                <td class="w3-small">designation</td>
                <td class="w3-small">department</td>
            </tr>
            <template x-for="(item, index) in users">
                <tr class="w3-white w3-border w3-hover-asphalt" x-on:click="console.log(item.id);pc.assigned_user=item.id; user.fullname=item.fullname; step5=true; step4=false; step3=false; step2=false; step1=false;" style="cursor:pointer;">
                    <td class="w3-padding" x-text="item.staff_id"></td>
                    <td class="w3-padding" x-text="item.fullname"></td>
                    <td class="w3-padding" x-text="item.designation_name"></td>
                    <td class="w3-padding" x-text="item.department_name"></td>
                </tr>
            </template>
        </table>
    </div>

    <!-- STEP 5, CONFIRMATION -->
    <div x-show="step5">
        <h3>Confirmation</h3>

        <div>
            <button x-on:click="step4=true; step5=false; step1=false; step2=false; step3=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="submit()" class="w3-button w3-asphalt w3-round">Confirm and Save</button>
        </div>

        <br>

        <p>Please verify and confirm the following info:</p>

        <div style="display:inline-block; margin-right: 1em;" class="w3-border w3-padding w3-round-large w3-white">
            <table style="float:left;">
                <colgroup>
                    <col width="150px">
                    <col width="150px">
                </colgroup>
                <!-- SITE -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">site</span>
                        <br>
                        <span x-text="site_name ? site_name : '&nbsp;'"></span>
                    </td>
                </tr>

                <!-- ASSET NO & SERIAL NO -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">asset no</span>
                        <br>
                        <span x-text="pc.asset_no ? pc.asset_no : '&nbsp;'"></span>
                    </td>
                    <td>
                        <span class="w3-small w3-text-gray">serial no</span>
                        <br>
                        <span x-text="pc.serial_no ? pc.serial_no : '-'"></span>
                    </td>
                </tr>

                <!-- MODEL & COMPUTER TYPE -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">model</span>
                        <br>
                        <span x-text="pc.model ? pc.model : '-'"></span>
                    </td>
                    <td>
                        <span class="w3-small w3-text-gray">computer type</span>
                        <br>
                        <span x-text="pc.computer_type ? pc.computer_type : '-'"></span>
                    </td>
                </tr>

                <!-- OS & IP ADDRESS -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">os</span>
                        <br>
                        <span x-text="pc.os ? pc.os : '-'"></span>
                    </td>
                    <td>
                        <span class="w3-small w3-text-gray">ip address</span>
                        <br>
                        <span x-text="pc.ip_address ? pc.ip_address : '-'"></span>
                    </td>
                </tr>

                <!-- PHYSICAL LOCATION -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">physical location</span>
                        <br>
                        <span x-text="pc.physical_location ? pc.physical_location : '-'"></span>
                    </td>
                </tr>

                <!-- NOTES -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">notes</span>
                        <br>
                        <span x-text="pc.notes ? pc.notes : '-'"></span>
                    </td>
                </tr>

            </table>
        </div>

        <div style="display:inline-block; vertical-align:top;">
            <!-- Monitor -->
            <div style="" class="w3-white w3-border w3-padding w3-round-large w3-margin-bottom">
                <div>
                    <span class="w3-small w3-text-gray">monitor</span>
                </div>
                <div>
                    <span x-text="monitor.asset_no ? monitor.asset_no : '-'"></span>
                </div>
            </div>

            <!-- User -->
            <div style="" class="w3-white w3-border w3-padding w3-round-large">
                <div>
                    <span class="w3-small w3-text-gray">user</span>
                </div>
                <div>
                    <span x-text="user.fullname ? user.fullname : '-'"></span>
                </div>
            </div>
        </div>

    </div>
</div>