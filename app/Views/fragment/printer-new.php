<div class="w3-container"
x-data="{
    step1: true, // choose site
    step2: false, // fill in detail
    step3: false, // select host
    step4: false, // confirmation
    disableStep2next: true,
    disableHostSelection: true,
    site_id: 1,
    site_name: 'DEFAULT',
    hosts: [],
    printer: {
        serial_no: '',
        model: '',
        nickname: '',
        printer_type: '',
        host: '',
        ip_address: '',
        is_rental: 0,
        notes: '',
        site: '',
    },
    host: {},
    loadHostList({hosts}) {
        minAjax({
            url: `/fragment/pc/api/get-by-site/${this.site_id}`,
            type: 'GET',
            success: (response) => {
                data = JSON.parse(response);
                this.hosts = data.pc;
            }
        });
    },
    getHostByID(id) {
        minAjax({
            url: `/fragment/pc/api/${id}`,
            type: 'GET',
            success: (response) => {
                data = JSON.parse(response);
                this.host = data.pc;
            }
        });
    },
    submit() {
        minAjax({
            url: '/fragment/printer/api/create',
            type: 'POST',
            data: {
                serial_no: this.printer.serial_no,
                model: this.printer.model,
                nickname: this.printer.nickname,
                printer_type: this.printer.printer_type,
                host: this.printer.host,
                ip_address: this.printer.ip_address,
                is_rental: this.printer.is_rental,
                notes: this.printer.notes,
                site: this.printer.site,
            },
            success: (response) => {
                data = JSON.parse(response);
                if (data['title']=='OK') {
                    console.log('OK');
                    window.location.href = '/fragment/printer';
                } else {
                    console.log('Failed');
                }
            },
        });
    }
    }">
    <h1>Add Printer</h1>

    <br>

    <!-- STEP 1 -->
    <div x-show="step1">
        <h3>Step 1 of 3 <b>Choose Site</b></h3>

        <div>
            <a href="/fragment/printer" class="w3-button w3-border w3-border-asphalt w3-round">cancel</a>
        </div>

        <br>

        <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 250px); column-gap: 20px;">
            <?php foreach($sites as $key=>$row): ?>
                <a class="w3-border w3-white w3-padding w3-round text-decoration-none w3-hover-asphalt" x-on:click="printer.site=<?= $row['id'] ?>;site_id=<?= $row['id'] ?>;site_name='<?= $row['site_id'] ?>';step1=false;step2=true;step3=false;step4=false;" style="cursor:pointer;">
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
            <button x-on:click="step1=true; step2=false; step3=false; step4=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button x-on:click="step1=false; step2=false; step3=true; step4=false; loadHostList($data);" class="w3-button w3-asphalt w3-round" x-bind:disabled="disableStep2next">Next</button>
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

            <!-- SERIAL NO -->
            <tr>
                <td>
                    <label class="w3-label">Serial No</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="printer.serial_no" type="text" name="serial_no" class="w3-input w3-border" x-effect="if (printer.serial_no!='' && printer.model!=''){disableStep2next=false;}else{disableStep2next=true;}" ></input>
                    <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                </td>
            </tr>

            <!-- MODEL -->
            <tr>
                <td>
                    <label class="w3-label">Model</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="printer.model" type="text" name="model" class="w3-input w3-border"></input>
                    <span class="w3-text-red position-absolute right-0 top--10px font-size-2rem user-select-none">*</span>
                </td>
            </tr>

            <!-- NICKNAME -->
            <tr>
                <td>
                    <label class="w3-label">Nickname</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="printer.nickname" type="text" name="nickname" class="w3-input w3-border"></input>
                </td>
            </tr>

            <!-- PRINTER TYPE -->
            <tr>
                <td>
                    <label class="w3-label">Printer type</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <select x-model="printer.printer_type" name="printer_type" class="w3-input w3-border">
                        <?php foreach($types as $key => $value): ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach ?> 
                    </select>
                </td>
            </tr>
            
            <!-- IS RENTAL -->
            <tr>
                <td>
                    <label class="w3-label">Is rental?</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <span>
                        <input type="radio" name="is_rental" value="0" id="isrental_no" x-model="printer.is_rental" class="w3-radio" />
                        <label for="isrental_no">No</label>
                    </span>

                    &nbsp;

                    <span>
                        <input type="radio" name="is_rental" value="1" id="isrental_yes" x-model="printer.is_rental" class="w3-radio" />
                        <label for="isrental_yes">Yes</label>
                    </span>
                </td>
            </tr>
            
            <!-- NOTES -->
            <tr>
                <td>
                    <label class="w3-label">Notes</label>
                    &nbsp;
                </td>
                <td class="position-relative">
                    <input x-model="printer.notes" type="text" name="notes" class="w3-input w3-border"></input>
                </td>
            </tr>
        </table>
    </div>

    <!-- STEP 3 -->
    <div x-show="step3">
        <h3>Step 3 of 3 <b>Assign Host</b> or <b>IP address</b></h3>

        <div>
            <button x-on:click="step2=true; step3=false; step1=false; step4=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
            <button
                x-on:click="step4=true; step3=false; step2=false; step1=false; if(printer.ip_address!=''){printer.host='';host={};};"
                class="w3-button w3-asphalt w3-round"
                x-text="printer.ip_address==''?'Skip':'Next'"
            ></button>
        </div>
        
        <br>

        <p>Enter the printer IP address (for standalone printers)</p>

        <div>
            <table>
                <tr>
                    <td>
                        <label>IP address</label>
                    </td>
                    <td>
                        <input type="text" class="w3-input w3-border w3-margin-left" x-model="printer.ip_address">
                    </td>
                </tr>
            </table>
        </div>

        <br>

        <p>OR pick a host PC below (if the printer is attached to PC)</p>

        <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 250px); column-gap: 20px;">
            <template x-for="(item, index) in hosts">
                <button
                    class="w3-border w3-white w3-padding w3-round w3-button"
                    x-on:click="printer.host=item.id; getHostByID(item.id); step1=false; step2=false; step3=false; step4=true;"
                    x-effect="if (printer.ip_address==''){disableHostSelection=false;}else{disableHostSelection=true;}"
                    x-bind:disabled="disableHostSelection"
                    style="height:80px; cursor:pointer;">
                    <div x-text="item.hostname"></div>
                    <div x-text="item.ip_address"></div>
                </button>
            </template>
        </div>
    </div>

    <!-- STEP 4, CONFIRMATION -->
    <div x-show="step4">
        <h3>Confirmation</h3>

        <div>
            <button x-on:click="step3=true; step1=false; step2=false; step4=false;" class="w3-button w3-border w3-border-asphalt w3-round">go back</button>
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

                <!-- SERIAL NO -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">serial no</span>
                        <br>
                        <span x-text="printer.serial_no ? printer.serial_no : '-'"></span>
                    </td>
                </tr>

                <!-- MODEL -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">model</span>
                        <br>
                        <span x-text="printer.model ? printer.model : '-'"></span>
                    </td>
                </tr>

                <!-- NICKNAME -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">nickname</span>
                        <br>
                        <span x-text="printer.nickname ? printer.nickname : '-'"></span>
                    </td>
                </tr>

                <!-- PRINTER TYPE -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">printer type</span>
                        <br>
                        <span x-text="printer.printer_type ? printer.printer_type : '-'"></span>
                    </td>
                </tr>

                <!-- NOTES -->
                <tr>
                    <td>
                        <span class="w3-small w3-text-gray">notes</span>
                        <br>
                        <span x-text="printer.notes ? printer.notes : '-'"></span>
                    </td>
                </tr>

            </table>
        </div>

        <div style="display:inline-block; vertical-align:top;">
            <!-- HOST OR IP ADDRESS -->
            <div class="w3-white w3-border w3-padding w3-round-large w3-margin-bottom">
                <div>
                    <span class="w3-small w3-text-gray">host or IP address</span>
                </div>
                <div>
                    <template x-if="printer.ip_address != ''">
                        <span x-text="printer.ip_address"></span>
                    </template>
                    <template x-if="printer.host != ''">
                        <span>
                            <p x-text="host.hostname"></p>
                            <p x-text="host.ip_address"></p>
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>