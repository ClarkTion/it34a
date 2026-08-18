<?php
    function logActivity($pdo, $user_id, $email, $action, $status='success'){
        try{
            //Get client IP Address
            $ip= $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER[' REMOTE_ADDR'] ??'Unkown';
            // String to Array
            if(strpos($ip, ',')!== false){
                $ip = trim(explode(',', $ip )[0]);
            }
            
            //Get user agent (Browser)
            $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',0,255);

            //Query
            $stmt = $pdo->prepare ("
                INSERT INTO activity_logs(
                user_id,
                user_email,
                activity_log_action,
                acitivty_log_status,
                activity_log_ip_address,
                user_agent
                ) VALUES (?,?,?,?,?,?)
            ");

        } catch (PDOException $e){
            error_log("Activity log Error:", $e->getMessage());
            return false;
        }
    }
?>