<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsNumberTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('DROP TRIGGER IF EXISTS leads_number');

        DB::unprepared("
            CREATE TRIGGER `leads_number` BEFORE INSERT ON `leads`
             FOR EACH ROW BEGIN
                DECLARE maincode VARCHAR(50) ;
                DECLARE parentcode VARCHAR(50) ;
                SELECT UPPER(HEX(UUID_SHORT())) into parentcode;
                SET new.parent_code = parentcode;
                SET new.main_code = parentcode;
                IF NEW.phone IS NOT NULL
                THEN 
                    IF NEW.phone in (
                        select A.phone
                        From leads A  where (NEW.phone = A.phone)
                    ) THEN
                        SELECT  parent_code into parentcode FROM leads where phone=NEW.phone ORDER BY id DESC limit 1;
                        IF parentcode IS NULL THEN
                            SELECT UPPER(HEX(UUID_SHORT())) into parentcode;
                        END IF;
                        SET new.parent_code = parentcode;
                        
                        SELECT UPPER(HEX(UUID_SHORT())) into maincode;
                        SET new.main_code = maincode;
                        
                    END IF;
                END IF;

                IF NEW.email IS NOT NULL
                THEN 
                    IF NEW.email in (
                        select A.email
                        From leads A  where (NEW.email = A.email)
                    ) THEN
                        SELECT  parent_code into parentcode FROM leads where email=NEW.email ORDER BY id DESC limit 1;
                        IF parentcode IS NULL THEN
                            SELECT UPPER(HEX(UUID_SHORT())) into parentcode;
                        END IF;
                        SET new.parent_code = parentcode;
                        
                        SELECT UPPER(HEX(UUID_SHORT())) into maincode;
                        SET new.main_code = maincode;
                    END IF;
                END IF;


                IF NEW.email IS NULL THEN
                        SET new.email = '-';
                END IF;
                IF NEW.phone IS NULL THEN
                        SET new.phone = '-';
                END IF;

            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads_number_trigger');
    }
}
