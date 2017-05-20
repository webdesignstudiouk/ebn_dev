<?php

echo "
  <ul ml-menu='' close-others='false' class='demo-navigation mdl-navigation'>
    <li ng-transclude='' ng-class='{ active: isActive }' ng-click='toggleActive()' class='ng-isolate-scope'><a class='mdl-navigation__link ng-scope' href='callbacks.php'><i class='mdl-color-text--blue-grey-400 material-icons'>dashboard</i>Callbacks</a></li>
    <li ng-transclude='' ng-class='{ active: isActive }' ng-click='toggleActive()' class='ng-isolate-scope'><a class='mdl-navigation__link ng-scope' href='users.php'><i class='mdl-color-text--blue-grey-400 material-icons'>dashboard</i>Users</a></li>
    

  </ul>
</div>



";
?>