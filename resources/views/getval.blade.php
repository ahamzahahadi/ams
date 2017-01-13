<?php $user = Auth::user();
if ($user)
{
    echo "Hello $user->name";
}
?>
