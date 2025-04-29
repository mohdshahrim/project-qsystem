<style>
.pl-1{
    padding-left:1em;
}
</style>
<main>
    <h3>About Fragment</h3>
    <p>version <?= FRAGMENT_VERSION_NO ?> (<?= FRAGMENT_VERSION_DATE ?>)</p>
    <br>
    <h3>Introduction</h3>
    <p>1. Fragment is a simple web-based IT inventory management system.</p>
    <p>2. For the purpose of staying true to its function, it can also be called "IT inventory database".</p>
    <p>3. This page (the About Page) will always display current version of Fragment. In the event of conflict, the version displayed above is the source of truth.</p>
    <p>4. Fragment is part of Qsystem, and shares the same "tech stack". For more information about tech stack, please refer to About Qsystem.</p>

    <br>

    <h3>Technical Information</h3>
    <p>1. Fragment versions are read from FragmentController</p>
        <code style="color:gray;">
        define('FRAGMENT_VERSION_NO', '1.0');<br>
        define('FRAGMENT_VERSION_DATE', '29/04/2025');<br>
        <br>
        class FragmentController extends BaseController<br>
        </code>
    <p>2. Fragment uses a loose naming convention, but often consistent when it comes to shortening long names.</p>
    <p class="pl-1">- when codifiying office or region, it uses long-short-shortest</p>
    <p class="pl-1">- for example: Sibu Regional Office - sibu - sbu</p>
    <p class="pl-1">- another example: Kapit Sub-Regional Office - kapit - kpt</p>
    <p class="pl-1">- shortest is also called codename</p>

    <div class="spacer"></div>
    <div class="spacer"></div>
</main>