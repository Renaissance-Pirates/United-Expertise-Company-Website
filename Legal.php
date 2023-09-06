<?php /* Template Name: Legal */ ?>

<?php get_header(); ?>
<main class="Legal Padding_4rem Background_Color_1">
	<?php
		$Document = '';
		if (isset ($_GET ['document']))
		{
			$Document = $_GET ['document'];
		}
		echo ($Document == 'terms-of-use' ? 
			'<h1>Website Terms of Use</h1>'
			.
			'<p>These terms of use ("Terms") govern your use of uec-env.com.sa ("the Website"), operated by United Expertise Company ("we," "us," or "our"). By accessing and using the Website, you agree to comply with these Terms. If you do not agree with these Terms, please refrain from using the Website.</p>'
			.
			'<h2>1. Acceptable Use</h2>'
			.
			'<p>You agree to use the Website in accordance with all applicable laws and regulations. You will not use the Website for any unlawful purpose, and you will not engage in any activity that could harm the Website, its users, or third parties.</p>'
			.
			'<h2>2. User Content</h2>'
			.
			'<p>Any content you submit to the Website, including comments, posts, and uploads, shall be referred to as "User Content." By submitting User Content, you grant us a non-exclusive, royalty-free, worldwide, perpetual, and irrevocable license to use, modify, adapt, distribute, display, and reproduce the User Content for the purpose of operating and promoting the Website.</p>'
			.
			'<h2>3. Intellectual Property</h2>'
			.
			'<p>All content on the Website, including but not limited to text, images, graphics, videos, and logos, is protected by copyright and other intellectual property laws. You may not reproduce, distribute, or create derivative works based on the content without our explicit permission.</p>'
			.
			'<h2>4. Disclaimer of Warranties</h2>'
			.
			'<p>The Website is provided "as is" and "as available." We make no representations or warranties of any kind, express or implied, regarding the accuracy, reliability, or availability of the Website. You use the Website at your own risk.</p>'
			.
			'<h2>5. Limitation of Liability</h2>'
			.
			'<p>In no event shall we be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or related to your use of the Website. Our total liability for any claims arising from your use of the Website shall not exceed SAR 0 or the total amount paid by you, whichever is lower.</p>'
			.
			'<h2>6. Links to Third-Party Websites</h2>'
			.
			'<p>The Website may contain links to third-party websites. These links are provided for your convenience only. We do not endorse or control the content of these websites, and we are not responsible for any loss or damage that may arise from your use of them.</p>'
			.
			'<h2>7. Modifications to Terms</h2>'
			.
			'<p>We reserve the right to modify these Terms at any time. Any changes will be effective upon posting the revised Terms on the Website. Your continued use of the Website after the changes will constitute your acceptance of the modified Terms.</p>'
			.
			'<h2>8. Governing Law</h2>'
			.
			'<p>These Terms shall be governed by and construed in accordance with the laws of Kingdom of Saudi Arabia. Any disputes arising from or related to these Terms shall be subject to the exclusive jurisdiction of the courts in Kingdom of Saudi Arabia.</p>'
			.
			'<h2>9. Contact Us</h2>'
			.
			'<p>If you have any questions or concerns about these Terms, you can contact us at <a href="mailto:info@uec-env.com.sa">info@uec-env.com.sa</a>.'
		: 
			($Document == 'privacy-policy' ? 
			'<h1>Privacy Policy</h1>'
			.
			'<p>This Privacy Policy ("Policy") outlines how United Expertise Company ("we," "us," or "our") collects, uses, and protects the personal information you provide when using uec-env.com.sa ("the Website"). By accessing and using the Website, you consent to the practices described in this Policy.</p>'
			.
			'<h2>1. Information We Collect</h2>'
			.
			'<p>We may collect various types of information from you, including but not limited to:</p>'
			.
			'<p>Personal Information: This may include your name, email address, contact information, and any other information you voluntarily provide through forms on the Website. Log Data: We collect information that your browser sends whenever you visit our Website. This may include your IP address, browser type, pages visited, and other usage information. Cookies: We use cookies to enhance your experience on the Website. You can control cookies through your browser settings.</p>'
			.
			'<h2>2. How We Use Your Information</h2>'
			.
			'<p>We may use the collected information for the following purposes:</p>'
			.
			'<p>To provide and improve our services. To communicate with you, respond to inquiries, and send updates about the Website. To analyze and monitor the usage of the Website and gather insights to improve our content and user experience.'
			.
			'<h2>3. Disclosure of Information</h2>'
			.
			'<p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent. However, we may share information under the following circumstances:</p>'
			.
			'<p>With trusted service providers who assist us in operating our Website and providing services. In response to legal requests, such as court orders or government regulations. To protect our rights, privacy, safety, or property, or that of others.</p>'
			.
			'<h2>4. Security</h2>'
			.
			'<p>We take reasonable measures to protect your personal information from unauthorized access, loss, misuse, or alteration. However, no method of transmission over the internet or electronic storage is completely secure.</p>'
			.
			'<h2>5. Third-Party Links</h2>'
			.
			'<p>Our Website may contain links to third-party websites. We do not control the content or practices of these websites and are not responsible for their privacy policies. We encourage you to review the privacy policies of these websites before providing any personal information.</p>'
			.
			'<h2>6. Your Choices</h2>'
			.
			'<p>You can control the personal information you provide by adjusting your browser settings and cookie preferences. You may also unsubscribe from our communications at any time.</p>'
			.
			'<h2>7. Children\'s Privacy</h2>'
			.
			'<p>Our Website is not directed at individuals under the age of 16, and we do not knowingly collect personal information from them.</p>'
			.
			'<h2>8. Changes to this Privacy Policy</h2>'
			.
			'<p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the updated Policy on the Website.</p>'
			.
			'<ph2>9. Contact Us</h2>'
			.
			'<p>If you have any questions or concerns about this Privacy Policy, you can contact us at <a href="mailto:info@uec-env.com.sa">info@uec-env.com.sa</a>.'
			:
			'')
		)
	?>
</main>
<?php get_footer(); ?>