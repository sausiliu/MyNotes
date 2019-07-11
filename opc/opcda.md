# opcda

## 参考文章

[Java OPC client开发踩坑记](https://www.jianshu.com/p/26391f0cbb6f)

[Connection to Matrikon OPC Simulation Server via Utgard](https://stackoverflow.com/questions/31701972/connection-to-matrikon-opc-simulation-server-via-utgard)

### 启动参数(IDEA)

 -h 127.0.0.1 -d lenovo -u xx-p xx -c F8582CF2-88FB-11D0-B850-00C0F0104305 -i "Triangle Waves.Money"

### 参考code

```java
package demo.opc;

import java.util.concurrent.Executors;
import java.util.logging.Level;
import java.util.logging.Logger;

import org.openscada.opc.lib.common.ConnectionInformation;
import org.openscada.opc.lib.da.AccessBase;
import org.openscada.opc.lib.da.DataCallback;
import org.openscada.opc.lib.da.Item;
import org.openscada.opc.lib.da.ItemState;
import org.openscada.opc.lib.da.Server;
import org.openscada.opc.lib.da.SyncAccess;

public class UtgardReaderDemo {
  /**
   * Main application, arguments are provided as system properties, e.g.<br>
   * java -Dhost="localhost" -Duser="admin" -Dpassword="secret" -jar demo.opc.jar<br>
   * Tested with a windows user having administrator rights<br>
   * @param args unused
   * @throws Exception in case of unexpected error
   */
  public static void main(String[] args) throws Exception {
    Logger.getLogger("org.jinterop").setLevel(Level.ALL); // Quiet => Level.OFF

    final String host = System.getProperty("host", "localhost");
    final String user = System.getProperty("user", System.getProperty("user.name"));
    final String password = System.getProperty("password");
    // Powershell: Get-ItemPropertyValue 'Registry::HKCR\Matrikon.OPC.Simulation.1\CLSID' '(default)'
    final String clsId = System.getProperty("clsId", "F8582CF2-88FB-11D0-B850-00C0F0104305");
    final String itemId = System.getProperty("itemId", "Saw-toothed Waves.Int2");

    final ConnectionInformation ci = new ConnectionInformation(user, password);
    ci.setHost(host);
    ci.setClsid(clsId);

    final Server server = new Server(ci, Executors.newSingleThreadScheduledExecutor());
    server.connect();

    final AccessBase access = new SyncAccess(server, 1000);
    access.addItem(itemId, new DataCallback() {
      public void changed(final Item item, final ItemState state) {
        System.out.println(state);
      }
    });

    access.bind();
    Thread.sleep(10_000L);
    access.unbind();
  }
}
```
