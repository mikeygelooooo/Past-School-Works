package object;

import entity.Entity;
import main.GamePanel;

public class OBJ_Door_Iron extends Entity {
    GamePanel gp;

    public static final String ojbName = "Iron Door";

    public OBJ_Door_Iron(GamePanel gp) {
        super(gp);

        this.gp = gp;

        type = type_obstacle;
        name = ojbName;

        down1 = setup("/objects/door_iron", gp.tileSize, gp.tileSize);

        collision = true;
        solidArea.x = 0;
        solidArea.y = 16;
        solidArea.width = 48;
        solidArea.height = 32;
        solidAreaDefaultX = solidArea.x;
        solidAreaDefaultY = solidArea.y;

        setDialog();
    }

    public void setDialog() {
        dialogs[0][0] = "This door does not yield to force.\nOnly wit may turn its hinges.";
    }

    public void interact() {
        startDialog(this, 0);
    }
}
