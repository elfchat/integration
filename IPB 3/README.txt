Installation
============

1. Open the file (elfchat.php) and edit all the constants in the beginning of the file begins with ELFCHAT_*.

2. Upload file (elfchat.php) to the server.

3. Create a link to this file:

    Go to Admin > Look & Feel  >  Manage Skin Sets & Templates  >  Manage Templates in IP.Board > Editing Set > globalTemplate

    Search:

        <li id='nav_discussion' class='left {parse variable="forumActive"}'><a href='{parse url="act=idx" seotitle="false" base="public"}' title='{$this->lang->words['go_to_discussion']}'>{$this->lang->words['discussion']}</a></li>
        <li id='nav_members' class='left {parse variable="membersActive"}'><a href='{parse url="app=members&amp;section=view&amp;module=list" base="public"}' title='{$this->lang->words['go_to_memberlist']}'>{$this->lang->words['tb_mlist']}</a></li>

    Add:

        <li class='left'><a href='elfchat.php'>Chat</a></li>
