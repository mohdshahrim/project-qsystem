<main>
    <h3>Fragment Setting</h3>
    <p>this only applies to your account</p>

    <div class="spacer"></div>

    <div style="width:500px; border:1px solid black; padding:1em;">
        <h4>PC table preferences</h4>
        <p style="color:green;font-size:small;">
            <?php
            if (isset($_SESSION['fragmentpcsetting']))
            {
                echo $_SESSION['fragmentpcsetting'];
            }
            ?>
        </p>
        <p>To prevent seeing too many unimportant columns, you can choose what columns you don't want to see. Tick to enable optional columns.</p>
        <form action="/fragment/setting/pc" method="post">
            <input type="hidden" name="userid" value="<?= $settingpc['userid'];?>"/>
            <table>
                <tr>
                    <td>
                        <label for="pc-type">type</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_type" value="0"/>
                        <input id="pc-type" type="checkbox" name="pc_type" value="1" <?php if($settingpc['pc_type']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-cpumodel">cpu model</label>
                    </td>
                    <td>
                    <input type="hidden" name="pc_cpumodel" value="0"/>
                        <input id="pc-cpumodel" type="checkbox" name="pc_cpumodel" value="1" <?php if($settingpc['pc_cpumodel']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-monitormodel">monitor model</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_monitormodel" value="0"/>
                        <input id="pc-monitormodel" type="checkbox" name="pc_monitormodel" value="1" <?php if($settingpc['pc_monitormodel']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-hosteddevices">hosted devices</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_hosteddevices" value="0"/>
                        <input id="pc-hosteddevices" type="checkbox" name="pc_hosteddevices" value="1" <?php if($settingpc['pc_hosteddevices']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-user">user</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_user" value="0"/>
                        <input id="pc-user" type="checkbox" name="pc_user" value="1" <?php if($settingpc['pc_user']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-department">department</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_department" value="0"/>
                        <input id="pc-department" type="checkbox" name="pc_department" value="1" <?php if($settingpc['pc_department']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-notes">notes</label>
                    </td>
                    <td>
                        <input type="hidden" name="pc_notes" value="0"/>
                        <input id="pc-notes" type="checkbox" name="pc_notes" value="1" <?php if($settingpc['pc_notes']){echo "checked";}?>/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="pc-office">office</label>
                    </td>
                    <td>
                        <input id="pc-office" type="checkbox" name="pc_office" <?php if($settingpc['pc_office']){echo "checked";}?>/>
                    </td>
                </tr>
            </table>
            <p><button type="submit">save</button></p>
        </form>
    </div>

    <div class="spacer"></div>
</main>