package forelesninger.forelesning12;

public class LiftOff {

	public static void main(String[] args) {
		for (int nedtelling = 10; nedtelling > 0; nedtelling--) {
			try {
				Thread.sleep(1000);
			} catch(InterruptedException ie) {
			}
			System.out.print(".");
			if (nedtelling == 0) {
				System.out.println("\nWe have a liftoff!");
			}
		}
		System.out.println("\nThat was fun - we can go home!");
	}
}