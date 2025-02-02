<style>
    /* itemtable = table used to contain the claim items */
    .itemtable-td {
        border:1px solid black;
        padding:1em;
    }
    .itemtable-tdlast {
        border:1px solid black;
        padding:1em; 
    }
</style>


<div class="div-right">
    <h2>Create claim</h2>

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
                <button onclick="addWo()" id="button-wo">add WO</button>
                <button onclick="addSubsistence()" id="button-subsistence">add Subsistence</button>
                <button onclick="addLodging()" id="button-lodging">add Lodging</button>
                <button onclick="addTicket()" id="button-ticket">add Ticket</button>
                <button onclick="addReload()" id="button-reload">add Reload</button>
                <button onclick="addOther()" id="button-other">add Other</button>
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

                    <tr>
                        <td class="itemtable-td">SBU/0001/2024</td>
                        <td class="itemtable-td">Subsistence allowance </td>
                        <td class="itemtable-td">#</td>
                        <td class="itemtable-td">75.00</td>
                        <td class="itemtable-td">x =</td>
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