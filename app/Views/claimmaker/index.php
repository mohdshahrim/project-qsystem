<style>
    /* itemtable = table used to contain the claim items */
    .itemtable-td {
        border:1px solid black;
        padding:1em;
    }
    /* for RM value alignment */
    .itemtable-td-value {
        text-align: right;
    }
    .itemtable-tdlast {
        border:1px solid black;
        padding:1em; 
    }
    /* dialog for items */
    .ditem[open] {
        top:50%;
        left:50%;
        position:absolute;
        transform: translate(-50%, -50%);
        width:200px;
    }
</style>


<div class="div-right">
    <h2>Create Claim</h2>
    <p>save no: -</p>

    <div class="spacer"></div>

    <table>
        <!-- claimant's name -->
        <tr>
            <td>Name</td>
            <td>
                <input id="input-name" type="text"/>
            </td>
        </tr>

        <!-- claimant's designation -->
        <tr>
            <td>Designation</td>
            <td>
                <input id="input-designation" type="text"/>
            </td>
        </tr>

        <!-- claimant's department -->
        <tr>
            <td>Department</td>
            <td>
                <input id="input-department" type="text"/>
            </td>
        </tr>

        <!-- claim purpose -->
        <tr>
            <td>Purpose</td>
            <td>
                <input id="input-purpose" type="text"/>
            </td>
        </tr>

        <!-- date of claim form -->
        <tr>
            <td>Date</td>
            <td>
                <input id="input-date" type="date"/>
            </td>
        </tr>

        <!-- type of claim -->
        <tr>
            <td>Type of claim</td>
            <td>
                <input type="checkbox" id="checkbox-entertainment"></input>
                <label for="type-entertainment">Entertainment</label>
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="checkbox-travelling"></input>
                <label for="type-travelling">Travelling</label>
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="checkbox-miscellaneous"></input>
                <label for="type-miscellaneous">Miscellaneous</label>
            </td>
        </tr>

        <!-- the add buttons -->
        <tr>
            <td colspan="2">
                <button onclick="dialogWO('CREATE',null,null)" id="button-wo">add WO</button>
                <button onclick="dialogSubsistence()" id="button-subsistence">add Subsistence</button>
                <button onclick="dialogLodging()" id="button-lodging">add Lodging</button>
                <button onclick="dialogTicket()" id="button-ticket">add Ticket</button>
                <button onclick="dialogReload()" id="button-reload">add Reload</button>
                <button onclick="dialogOther()" id="button-other">add Other</button>
            </td>
        </tr>

        <!-- claim items (nested table) -->
        <tr>
            <td colspan="2">
                <table id="table-items" style="border-collapse:collapse;">
                    <tr>
                        <td class="itemtable-td">WO</td>
                        <td class="itemtable-td">Description</td>
                        <td class="itemtable-td">#</td>
                        <td class="itemtable-td">Value</td>
                        <td class="itemtable-td">Option</td>
                    </tr>

                    <!-- last row, display grand total -->
                    <tr>
                        <td class="itemtable-tdlast" colspan="3" style="text-align:right;">Grand total (RM)</td>
                        <td class="itemtable-tdlast" colspan="2">0.00</td>
                    </tr>
                <table>
            </td>
        </tr>

        <!-- font size -->
        <tr>
            <td>Font size</td>
            <td>
            <p>
                <input id="radio-fontlarge" type="radio" name="fontsize" value="large">
                <label title="rendered in 16px" for="large">Large (12 pt)</label>
                &nbsp;&nbsp;&nbsp;
                <input id="radio-fontmedium" type="radio" name="fontsize" value="medium" checked="true">
                <label title="default, rendered in 14px" for="medium">Medium (11 pt)</label>
                &nbsp;&nbsp;&nbsp;
                <input id="radio-fontsmall" type="radio" name="fontsize" value="small">
                <label title="rendered in 12px" for="small">Small (9 pt)</label>
                </p>
            </td>
        </tr>

        <!-- button to submit the form -->
        <tr>
            <td colspan="2">
                <button id="button-generatepdf">Generate PDF</button>
                <span style="font-size:small;"> this will be saved into History if you're logged on</span>
            </td>
        </tr>

    </table>

</div>

<div class="spacer"></div>
<div class="spacer"></div>

<!-- storing dialog elements below -->
<dialog id="dwo" class="ditem">
    <p>Greetings, one and all!</p>
    <form method="dialog">
        <button>OK</button>
    </form>
</dialog>