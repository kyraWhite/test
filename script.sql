CREATE TABLE person
(
  id            INT AUTO_INCREMENT
    PRIMARY KEY,
  name          VARCHAR(255)                 NOT NULL,
  position      VARCHAR(255)                 NOT NULL,
  work_start_dt DATE                         NOT NULL,
  status        TINYINT UNSIGNED DEFAULT '1' NOT NULL
)
  ENGINE = InnoDB;


