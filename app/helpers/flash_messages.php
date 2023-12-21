<?php
session_start();
function flash($name = '', $title = '', $message = '')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_title'])) {
                unset($_SESSION[$name . '_title']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_title'] = $title;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $title = !empty($_SESSION[$name . '_title']) ? $_SESSION[$name . '_title'] : '';
            echo '
                <br/>
                <div class="container ">
                <div class="alert section-title box rounded w-50 mx-auto shadow-sm" role="alert">
                    <h4 class="alert-heading title">'. $_SESSION[$name . '_title'] .'</h4>
                    <p>'. $_SESSION[$name] .'</p>
                </div>
                </div>
            ';
              
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_title']);
            }
        }
    }


function admin_flash($name = '', $title = '', $message = '')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_title'])) {
                unset($_SESSION[$name . '_title']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_title'] = $title;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $title = !empty($_SESSION[$name . '_title']) ? $_SESSION[$name . '_title'] : '';
            echo '
                    <div class="container">
                    <div class="alert alert-light border border-0 rounded w-50 mx-auto shadow-sm" role="alert">
                    <div class="modal-header">
                            <h5 class="modal-title">' . $_SESSION[$name . '_title'] . '</h5>
                        </div>
                        <hr class="bg-dark">
                    ' . $_SESSION[$name] . '
                    </div>
                    </div>
            ';

            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_title']);
        }
    }
}
